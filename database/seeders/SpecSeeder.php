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
            ["name" => "RAM","suffix" => "GB"],
            ["name" => "Storage", "suffix" => "GB"],
            ["name" => "Battery", "suffix" => "mAh"],
            ["name" => "Front Camera", "suffix" => "MP"],
            ["name" => "Rear Camera", "suffix" => "MP"],
            ["name" => "Display"],
            ["name" => "CPU"],
            ["name" => "GPU"],
            ["name" => "Operating System"],
            ["name" => "Weight", "suffix" => "kg"],
            ["name" => "Material"],
            ["name" => "Color"],
            ["name" => "Size", "suffix" => "mm"],
        ];

        foreach ($specs as $spec) {
            \App\Models\Spec::create($spec);
        }
    }
}
