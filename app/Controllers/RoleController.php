<?php

namespace App\Controllers;

use App\Models\RoleModel;
use App\Models\PermissionModel;
use App\Controllers\BaseController;

class RoleController extends BaseController
{
    protected $roleModel;
    protected $permissionModel;

    public function __construct()
    {
        $this->roleModel = new RoleModel();
        $this->permissionModel = new PermissionModel();
    }
    //index section provides roles list
    public function index()
    {
        $data = [
            'menu' => 'user',
            'page_title' => 'Roles List',   //used inside the content section in view file   
            'title' => 'Roles List',    //used in main layout for for page title
        ];
        return view('backend/user/roles_list', $data);  //calling the view file $data passing data needed for view file
    }

    //create method used to create new role
    public function create()
    {
        //checks the incoming method
        if ($this->request->getMethod() === 'post') {
            
            return $this->save();   //calling to the save function used to create and edit role 
        }

        $data = [
            'menu' => 'user',
            'page_title' => 'Create Role',  //used inside the content section in view file 
            'title' => 'Create Role',   //used in main layout for for page title
        ];
        return view('backend/user/roles_form', $data);  //calling the view file $data passing data needed for view file
    }

    //edit method used to edit existing role
    public function edit($id)
    {
        $role = $this->roleModel->find($id);    //getting the data from model
        //checking for record of particular id
        if (!$role) {
            session()->setFlashdata('swal_error', 'Role not found!');   //set error message
            return redirect()->to('/roles')->with('error', 'Role not found.');  //redirecting to the index method
        }
        //checks the incoming method
        if ($this->request->getMethod() === 'post') {
            return $this->save($id);    //calling to the save function used to create and edit role 
        }

        $data = [
            'menu' => 'user',
            'page_title' => 'Edit Role',    //used inside the content section in view file
            'title' => 'Edit Role', //used in main layout for for page title
            'role' => $role,    //data for the edit form
        ];
        return view('backend/user/roles_form', $data);  //calling the view file $data passing data needed for view file
    }

    //save method used to create and edit role
    protected function save($id = null)
    {
        //setting validation for the forms
        $validationRules = [
            'name' => 'required|min_length[3]|max_length[50]|is_unique[roles.name,id,' . ($id ?? '0') . ']',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $roleData = ['name' => $this->request->getPost('name')];

        if ($id) {
            $this->roleModel->update($id, $roleData);
            session()->setFlashdata('swal_success', 'Role updated Succesfully!');
            return redirect()->to('/roles')->with('success', 'Role updated successfully.');
        } else {
            $this->roleModel->insert($roleData);
            session()->setFlashdata('swal_success', 'Role created succesfully!');
            return redirect()->to('/roles')->with('success', 'Role created successfully.');
        }
    }

    public function delete($id)
    {
        if ($this->roleModel->find($id)) {
            $this->roleModel->delete($id);
            session()->setFlashdata('swal_error', 'Role deleted successfully!');
            return redirect()->to('/roles')->with('success', 'Role deleted successfully.');
        }

        session()->setFlashdata('swal_error', 'Role not found!');
        return redirect()->to('/roles')->with('error', 'Role not found.');
    }

    //Data section for datatable
    public function getData()
    {
        $model = new RoleModel();
        $request = \Config\Services::request();

        // Get the DataTable parameters
        $draw = $request->getPost('draw');
        $start = $request->getPost('start');
        $length = $request->getPost('length');
        $searchValue = $request->getPost('search')['value'];

        // Get the total count of records
        $totalRecords = $model->countAll();

        // Apply search filter if any
        if (!empty($searchValue)) {
            $model->like('name', $searchValue);
        }

        // Get the filtered records
        $filteredRecords = $model->countAllResults();

        // Get the actual data
        $data = $model->like('name', $searchValue)->findAll($length, $start);

        // Add action buttons for each row
        foreach ($data as &$row) {
            $row['actions'] = '<button class="btn btn-info btn-sm edit-btn" data-id="' . $row['id'] . '">Edit</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="' . $row['id'] . '">Delete</button>
                            <button class="btn btn-success btn-sm permission-btn" data-id="' . $row['id'] . '">Permission</button>';
        }

        $response = [
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data,
        ];

        return $this->response->setJSON($response);
    }

    // Assign permissions to a role
    public function assignPermissions($roleId)
    {
        $role = $this->roleModel->find($roleId);
        if (!$role) {
            session()->setFlashdata('swal_error', 'Role not found!');
            return redirect()->to('/roles');
        }

        if ($this->request->getMethod() === 'post') {
            $permissions = $this->request->getPost('permissions');
            if (is_array($permissions)) {
                $db = \Config\Database::connect();
                $builder = $db->table('role_permissions');
                $builder->where('role_id', $roleId)->delete();

                $permissionData = array_map(function ($permissionId) use ($roleId) {
                    return ['role_id' => $roleId, 'permission_id' => $permissionId];
                }, $permissions);

                $builder->insertBatch($permissionData);

                session()->setFlashdata('swal_success', 'Permissions assigned successfully!');
                return redirect()->to('/roles');
            }
        }

        $permissions = $this->permissionModel->findAll();
        $assignedPermissions = $this->roleModel->getPermissions($roleId);

        $data = [
            'page_title' => 'Assign Permissions',
            'title' => 'Assign Permissions',
            'role' => $role,
            'permissions' => $permissions,
            'assigned_permissions' => array_column($assignedPermissions, 'id'),
        ];

        return view('backend/user/assign_permissions', $data);
    }

}
