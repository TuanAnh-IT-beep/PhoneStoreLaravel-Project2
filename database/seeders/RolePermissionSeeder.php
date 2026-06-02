<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owner = Role::findByName('Owner', 'admin');
        $owner->givePermissionTo(Permission::where('guard_name', 'admin')->get());
        $admin = Role::findByName('Admin', 'admin');
        $admin->givePermissionTo(['manage_users', 'manage_products', 'manage_orders', 'manage_customers']);
        $pm = Role::findByName('Product Manager', 'admin');
        $pm->givePermissionTo('manage_products');
        $om = Role::findByName('Order Manager', 'admin');
        $om->givePermissionTo(['manage_orders', 'manage_customers']);
        $support = Role::findByName('Support', 'admin');
        $support->givePermissionTo('manage_customers');
    }
}
