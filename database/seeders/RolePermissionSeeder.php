<?php

namespace Database\Seeders;

use App\Constants\Permission as PermissionConstant;
use App\Constants\Role as RoleConstant;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Defined permissions with group names in Constants
        $permissions = [
            [
                'group_name' => PermissionConstant::GROUP_KYC,
                'permissions' => [
                    PermissionConstant::MANAGE_KYC,
                ]
            ],
            [
                'group_name' => PermissionConstant::GROUP_ROLE_MANAGEMENT,
                'permissions' => [
                    PermissionConstant::MANAGE_ROLE,
                    PermissionConstant::MANAGE_ADMIN_ACCOUNT,
                ]
            ],
        ];

        foreach ($permissions as $group) {
            $groupName = $group['group_name'];
            foreach ($group['permissions'] as $permissionName) {
                $permission = Permission::firstOrCreate(
                    [
                        'name' => $permissionName,
                        'guard_name' => RoleConstant::GUARD_ADMIN,
                    ],
                    [
                        'group_name' => $groupName
                    ]
                );

                if ($permission->group_name !== $groupName) {
                    $permission->update(['group_name' => $groupName]);
                }
            }
        }

        // Create Super Admin role
        $superAdminRole = Role::firstOrCreate([
            'name' => RoleConstant::SUPER_ADMIN,
            'guard_name' => RoleConstant::GUARD_ADMIN,
        ]);

        // Give all permissions to Super Admin role
        $superAdminRole->syncPermissions(Permission::where('guard_name', RoleConstant::GUARD_ADMIN)->get());

        // Assign Super Admin role to the main admin
        $admin = Admin::where('email', RoleConstant::SUPER_ADMIN_EMAIL)->first();
        if ($admin) {
            $admin->assignRole($superAdminRole);
        }

        // 1. Create sample "Quản lý KYC" role
        $kycRole = Role::firstOrCreate([
            'name' => 'Quản lý KYC',
            'guard_name' => RoleConstant::GUARD_ADMIN,
        ]);
        $kycRole->syncPermissions([PermissionConstant::MANAGE_KYC]);

        // Create sample Admin user with "Quản lý KYC" role
        $kycAdmin = Admin::firstOrCreate(
            ['email' => 'kycadmin@gmail.com'],
            [
                'name' => 'KYC Manager',
                'password' => bcrypt('12345678'),
            ]
        );
        $kycAdmin->syncRoles([$kycRole]);

        // 2. Create sample "Manager" role
        $managerRole = Role::firstOrCreate([
            'name' => 'Manager',
            'guard_name' => RoleConstant::GUARD_ADMIN,
        ]);
        $managerRole->syncPermissions([
            PermissionConstant::MANAGE_KYC,
            PermissionConstant::MANAGE_ADMIN_ACCOUNT,
        ]);

        // Create sample Admin user with "Manager" role
        $managerAdmin = Admin::firstOrCreate(
            ['email' => 'manager@gmail.com'],
            [
                'name' => 'Manager Admin',
                'password' => bcrypt('12345678'),
            ]
        );
        $managerAdmin->syncRoles([$managerRole]);
    }
}
