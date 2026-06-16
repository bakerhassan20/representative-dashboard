<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Role::create([
            'name'=>'Super Admin'
        ]);

        Role::create([
            'name'=>'Admin'
        ]);

        Role::create([
            'name'=>'Accountant'
        ]);

        Permission::create([
            'name'=>'view clients'
        ]);

        Permission::create([
            'name'=>'create clients'
        ]);

        Permission::create([
            'name'=>'edit clients'
        ]);

        Permission::create([
            'name'=>'delete clients'
        ]);         
    }
}
