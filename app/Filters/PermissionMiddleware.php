<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\RoleModel;
use App\Models\UserRoleModel;

class PermissionMiddleware implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'You must be logged in.');
        }

        $permissionName = $arguments[0];
        $roleModel = new RoleModel();
        $userRoleModel = new UserRoleModel();

        // Get user roles
        $userRoles = $userRoleModel->where('user_id', $userId)->findAll();

        foreach ($userRoles as $role) {
            $permissions = $roleModel->getPermissions($role['role_id']);
            foreach ($permissions as $permission) {
                if ($permission['name'] === $permissionName) {
                    return; // Permission granted
                }
            }
        }

        // Deny access if no matching permission
        return redirect()->to('/unauthorized')->with('error', 'Access denied!');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Optional post-processing
    }
}
