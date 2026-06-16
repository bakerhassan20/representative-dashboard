<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Permissions
        $permissions = [
            'manage users',
            'manage clients',
            'manage payments',
            'manage settings',
            'view dashboard',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Roles
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $accountant = Role::firstOrCreate(['name' => 'Accountant']);

        // Assign all permissions to Super Admin
        $superAdmin->syncPermissions($permissions);

        // Admin permissions
        $admin->syncPermissions([
            'manage clients',
            'manage payments',
            'view dashboard',
        ]);

        // Accountant permissions
        $accountant->syncPermissions([
            'manage payments',
            'view dashboard',
        ]);
    }
}