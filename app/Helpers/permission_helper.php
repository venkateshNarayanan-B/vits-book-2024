<?php

/**
 * Helper function to check if the logged-in user has a specific permission.
 *
 * @param string $permissionName The name of the permission to check.
 * @return bool Returns true if the user has the specified permission, false otherwise.
 */
function has_permission($permissionName)
{
    
    $session = session();

    // Get the logged-in user's ID from the session
    $userId = $session->get('user_id');
    
    if (!$userId) {
        return false; // User is not logged in
    }
    
    // Load the required models
    $roleModel = new \App\Models\RoleModel();
    $userRoleModel = new \App\Models\UserRoleModel();

    // Fetch all roles associated with the user
    $userRole = $userRoleModel->where('user_id', $userId)->first();
   
    if (empty($userRole)) {
        return false; // No roles assigned to the user
    }

    // Check each role's permissions
    
    $permissions = $roleModel->getPermissions($userRole['role_id']); // Retrieve permissions for the role
    
    // Check if the required permission is in the list of permissions
    foreach ($permissions as $permission) {
        if ($permission['name'] === $permissionName) {
            return true; // Permission found
        }
    }
    

    return false; // Permission not found
}
