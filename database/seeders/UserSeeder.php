<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                "username" => "pdn",
                "password" => bcrypt(value: "12345678"),
                "email" => "pdn@example.com",
                "phone" => "0123456789",
                "full_name" => "PDN",
                "role_id" => 1
            ]
        ];

        foreach ($users as $user) {
            \App\Models\User::create($user);
        }

    }
}
