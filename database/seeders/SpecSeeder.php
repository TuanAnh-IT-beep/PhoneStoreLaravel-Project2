<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specs = [
            ["name" => "RAM"],
            ["name" => "Storage"],
            ["name" => "Battery"],
            ["name" => "Front Camera"],
            ["name" => "Rear Camera"],
            ["name" => "Display"],
            ["name" => "CPU"],
            ["name" => "GPU"],
            ["name" => "Operating System"],
            ["name" => "Weight"],
            ["name" => "Material"],
            ["name" => "Color"],
            ["name" => "Size"],
        ];

        foreach ($specs as $spec) {
            \App\Models\Spec::create($spec);
        }
    }
}
