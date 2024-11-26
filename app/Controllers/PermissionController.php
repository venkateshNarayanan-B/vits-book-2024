<?php

namespace App\Controllers;

use App\Models\PermissionModel;
use App\Models\RoleModel;
use App\Controllers\BaseController;

class PermissionController extends BaseController
{
    protected $permissionModel;
    protected $roleModel;

    public function __construct()
    {
        $this->permissionModel = new PermissionModel();
        $this->roleModel = new RoleModel();
    }

    // Display all permissions
    public function index()
    {
        $data = [
            'menu' => 'user',
            'page_title' => 'Permissions List',
            'title' => 'Permissions List',
            'permissions' => $this->permissionModel->findAll(),
        ];
        return view('backend/user/permissions_list', $data);
    }

    // Create new permission
    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            return $this->save();
        }

        $data = [
            'menu' => 'user',
            'page_title' => 'Create Permission',
            'title' => 'Create Permission',
        ];
        return view('backend/user/permissions_form', $data);
    }

    // Edit permission
    public function edit($id)
    {
        $permission = $this->permissionModel->find($id);
        if (!$permission) {
            session()->setFlashdata('swal_error', 'Permission not found!');
            return redirect()->to('/permissions')->with('error', 'Permission not found.');
        }

        if ($this->request->getMethod() === 'post') {
            return $this->save($id);
        }

        $data = [
            'menu' => 'user',
            'page_title' => 'Edit Permission',
            'title' => 'Edit Permission',
            'permission' => $permission,
        ];
        return view('backend/user/permissions_form', $data);
    }

    // Save new or updated permission
    protected function save($id = null)
    {
        $validationRules = [
            'name' => 'required|min_length[3]|max_length[50]|is_unique[permissions.name,id,' . ($id ?? '0') . ']',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $permissionData = [
            'name' => $this->request->getPost('name'),
        ];

        if ($id) {
            $this->permissionModel->update($id, $permissionData);
            session()->setFlashdata('swal_success', 'Permission updated successfully!');
            return redirect()->to('/permissions')->with('success', 'Permission updated successfully.');
        } else {
            $this->permissionModel->insert($permissionData);
            session()->setFlashdata('swal_success', 'Permission created successfully!');
            return redirect()->to('/permissions')->with('success', 'Permission created successfully.');
        }
    }

    // Delete permission
    public function delete($id)
    {
        if ($this->permissionModel->find($id)) {
            $this->permissionModel->delete($id);
            session()->setFlashdata('swal_error', 'Permission deleted successfully!');
            return redirect()->to('/permissions')->with('success', 'Permission deleted successfully.');
        }

        session()->setFlashdata('swal_error', 'Permission not found!');
        return redirect()->to('/permissions')->with('error', 'Permission not found.');
    }

    //Data section for datatable
    public function getData()
    {
        $model = new PermissionModel();
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
                            <button class="btn btn-danger btn-sm delete-btn" data-id="' . $row['id'] . '">Delete</button>';
        }

        $response = [
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data,
        ];

        return $this->response->setJSON($response);
    }
}
