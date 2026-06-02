<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\Permission;
use App\Models\Spec;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class SettingsController
{
    public function index()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        $payment_methods = PaymentMethod::all();
        $specs = Spec::all();
        return view('admins.settings.index', compact('permissions', 'roles', 'payment_methods', 'specs'));
    }
}
