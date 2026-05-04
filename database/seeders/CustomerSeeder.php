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
                'username' => 'tuananh',
                'password' => bcrypt('12345678'),
                'icon' => null,
                'display_name' => 'tuananh',
                'email' => 'cactustg252006@gmail.com'
            ]
        ];
        \App\Models\Customer::insert($customers);

    }
}
