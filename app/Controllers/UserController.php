<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\UserRoleModel;
use App\Controllers\BaseController;

class UserController extends BaseController
{
    protected $userModel;
    protected $roleModel;
    protected $userRoleModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
        $this->userRoleModel = new UserRoleModel();
    }

    public function index()
    {
        $data = [
            'menu' => 'user',
            'page_title' => 'User List',
            'title' => 'User List',
            'users' => $this->userModel->findAll(),
        ];
        return view('backend/user/index', $data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            return $this->save();
        }

        $data = [
            'menu' => 'user',
            'page_title' => 'Create User',
            'title' => 'Create User',
            'roles' => $this->roleModel->findAll(),
        ];
        return view('backend/user/user_form', $data);
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/user')->with('error', 'User not found.');
        }

        if ($this->request->getMethod() === 'post') {
            return $this->save($id);
        }

        $assignedRoles = $this->userRoleModel->where('user_id', $id)->findColumn('role_id');

        $data = [
            'menu' => 'user',
            'page_title' => 'Edit User',
            'title' => 'Edit User',
            'user' => $user,
            'roles' => $this->roleModel->findAll(),
            'assignedRoles' => $assignedRoles,
        ];
        return view('backend/user/user_form', $data);
    }

    protected function save($id = null)
    {
        // Set validation rules
        $validationRules = [
            'name' => 'required|min_length[3]|max_length[50]',
            'email' => 'required|valid_email|is_unique[users.email,id,' . $id . ']',
            'roles' => 'required'
        ];

        // If the user is updating or setting a new password
        if (is_null($id) || $this->request->getPost('password')) {
            $validationRules['password'] = 'required|min_length[6]';
            $validationRules['password_confirm'] = 'required|matches[password]';
        }

        // Validate the data
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Prepare the user data
        $userData = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ];

        // If there's a new password, hash it
        if ($this->request->getPost('password')) {
            $userData['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
        }

        // Insert or update user data
        if ($id) {
            $this->userModel->update($id, $userData);
            $this->userRoleModel->where('user_id', $id)->delete();
        } else {
            $id = $this->userModel->insert($userData);
        }

        // Assign role (only one role selected from radio buttons)
        $role = $this->request->getPost('roles');
        if ($role) {
            $this->userRoleModel->insert([
                'user_id' => $id,
                'role_id' => $role,
            ]);
        }

        // Success message
        return redirect()->to('/user')->with('success', $id ? 'User updated successfully!' : 'User created successfully!');
    }

    public function delete($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/user')->with('error', 'User not found.');
        }

        // Delete associated roles and the user
        $this->userRoleModel->where('user_id', $id)->delete();
        $this->userModel->delete($id);

        return redirect()->to('/user')->with('success', 'User deleted successfully.');
    }

    // Data section for DataTable
    public function getData()
    {
        $model = new UserModel();
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
            $model->like('name', $searchValue)
                ->orLike('email', $searchValue);
        }

        // Get the filtered records
        $filteredRecords = $model->countAllResults(false);

        // Get the actual data
        $data = $model->like('name', $searchValue)
                    ->orLike('email', $searchValue)
                    ->findAll($length, $start);

        // Add the roles to the user data
        foreach ($data as &$row) {
            // Fetch roles associated with the user
            $roles = $this->userRoleModel
                        ->join('roles', 'roles.id = user_roles.role_id')
                        ->where('user_roles.user_id', $row['id'])
                        ->findAll();

            // Convert roles into a comma-separated string
            $roleNames = array_map(function ($role) {
                return $role['name']; // Assuming 'name' is the field for the role name
            }, $roles);

            // Add roles to the user data
            $row['roles'] = implode(', ', $roleNames); // Combine role names into a string

            // Add action buttons for each row
            
            $row['actions'] = $this->action_button($row['id']);
        }

        $response = [
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data,
        ];

        return $this->response->setJSON($response);
    }

    //action button with permission check
    public function action_button($id = null)
    {
        $edit_button = null;
        $delete_button = null;
        
        if(has_permission('user update'))
        {
            $edit_button = '<button class="btn btn-info btn-sm edit-btn" data-id="' . $id . '">Edit</button>';
        }
        if(has_permission('user delete'))
        {
            $delete_button = ' <button class="btn btn-danger btn-sm delete-btn" data-id="' . $id . '">Delete</button>';
        }

        return $edit_button.$delete_button;
    }
}
