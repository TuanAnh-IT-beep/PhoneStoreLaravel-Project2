<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'username' => 'guest',
                'password' => bcrypt('12345678'),
                'display_name' => 'Guest',
                'email' => 'guest@example.com',
                'phone' => '0123456789',
            ]
        ];
        \App\Models\Customer::insert($customers);

    }
}
