<?php

use App\Constants\Role;

if (!function_exists('hasPermission')) {
    /**
     * Check if current logged in admin user has any of the specified permissions.
     *
     * @param array $permissions
     * @return bool
     */
    function hasPermission(array $permissions): bool
    {
        $user = auth('admin')->user();

        if (!$user) {
            return false;
        }

        if ($user->hasRole(Role::SUPER_ADMIN)) {
            return true;
        }

        return $user->hasAnyPermission($permissions);
    }
}
