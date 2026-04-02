<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ManufacturerSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(SpecSeeder::class);
        $this->call(SubproductSeeder::class);
        $this->call(SubSpecSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(OrderDetailSeeder::class);
        $this->call(ProductImageSeeder::class);
        $this->call(PaymentMethodSeeder::class);

    }
}
