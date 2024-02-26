<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                "name" => "superadmin"
            ],
            [
                "name" => "customer"
            ]
        ];

        $permissions = [
            ["name" => "customer-list"],
            ["name" => "customer-view"],
            ["name" => "customer-create"],
            ["name" => "customer-edit"],
            ["name" => "customer-delete"],
            ["name" => "project-list"],
            ["name" => "project-view"],
            ["name" => "project-create"],
            ["name" => "project-edit"],
            ["name" => "project-delete"],

        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
