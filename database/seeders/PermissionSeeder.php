<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ["name" => "manage_users", "guard_name" => "admin"],
            ["name" => "manage_products", "guard_name" => "admin"],
            ["name" => "manage_orders", "guard_name" => "admin"],
            ["name" => "manage_customers", "guard_name" => "admin"],
            ["name" => "manage_settings", "guard_name" => "admin"],
        ];

        foreach ($permissions as $permission) {
            \App\Models\Permission::create($permission);
        }
    }
}
