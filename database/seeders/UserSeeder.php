<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'pdn',
            'password' => bcrypt(value: '12345678'),
            'email' => 'pdn@example.com',
            'phone' => '0123456789',
            'full_name' => 'PDN',
        ])->assignRole(Role::findByName('Owner', 'admin'));

    }
}
