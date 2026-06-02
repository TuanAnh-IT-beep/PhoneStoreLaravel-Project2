<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ["name" => "Owner", "guard_name" => "admin", 'level' => 999],
            ["name" => "Admin", "guard_name" => "admin", 'level' => 3],
            ["name" => "Product Manager", "guard_name" => "admin", 'level' => 2],
            ["name" => "Order Manager", "guard_name" => "admin", 'level' => 2],
            ["name" => "Support", "guard_name" => "admin", 'level' => 1],
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
