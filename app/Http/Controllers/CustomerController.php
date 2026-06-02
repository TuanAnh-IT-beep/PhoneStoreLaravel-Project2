<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class CustomerController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();

        return view('admins.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        if (Customer::where('username', $request->username)->exists()) {
            return back()->with('error', 'Username already exists.');
        }
        if (Customer::where('email', $request->email)->exists()) {
            return back()->with('error', 'Email already exists.');
        }
        if (str($request->password)->length < 8) {
            return back()->with('error', 'Password must be at least 8 characters.');
        }
        $iconPath = null;
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('customer_icons', 'public');
        }
        Customer::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'icon' => $iconPath,
            'display_name' => $request->display_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'birthday' => date('Y-m-d', strtotime($request->birthday)),
            'address' => $request->address,
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view(
            'admins.customers.edit',
            [
                'customer' => $customer,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        if (Customer::where('username', $request->username)->where('id', '!=', $customer->id)->exists()) {
            return back()->with('error', 'Username already exists.');
        }
        if (Customer::where('email', $request->email)->where('id', '!=', $customer->id)->exists()) {
            return back()->with('error', 'Email already exists.');
        }
        $iconPath = $customer->icon;
        if ($request->hasFile('icon')) {
            if ($customer->icon) {
                Storage::disk('public')->delete($customer->icon);
            }
            $iconPath = $request->file('icon')->store('customer_icons', 'public');
        }
        $customer->update([
            'username' => $request->username,
            'display_name' => $request->display_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'icon' => $iconPath,
            'birthday' => $request->birthday ? date('Y-m-d', strtotime($request->birthday)) : null,
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }

    public function login()
    {
        if (auth('client')->user()) {
            return redirect()->route('home');
        }

        return view('clients.login');
    }

    public function loginProcess(Request $request)
    {
        if (Auth::guard('client')->attempt(['email' => $request->login, 'password' => $request->password]) || Auth::guard('client')->attempt(['username' => $request->login, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->route('home');
        } else {
            return Redirect::back()->with('error', 'Invalid email or password.');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('client')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function register()
    {
        return view('clients.Register');
    }

    public function registerProcess(Request $request)
    {
        if (Customer::where('username', $request->username)->exists()) {
            return back()->with('error', 'Username already exists.');
        }
        if (Customer::where('email', $request->email)->exists()) {
            return back()->with('error', 'Email already exists.');
        }
        if (str($request->password)->length < 8) {
            return back()->with('error', 'Password must be at least 8 characters.');
        }
        $iconPath = null;
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('customer_icons', 'public');
        } else {
            $iconPath = 'customer_icons/default.png';
        }
        Customer::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'icon' => $iconPath,
            'display_name' => $request->display_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'birthday' => date('Y-m-d', strtotime($request->birthday)),
            'address' => $request->address,
        ]);

        return redirect()->route('clients.login')->with('success', 'Customer created successfully.');
    }

    public function getProfile()
    {
        $cus = auth()->guard('client')->user();

        return view('clients.updateProfile', compact('cus'));
    }

    public function updateProfile(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer = auth()->guard('client')->user();
        if (Customer::where('email', $request->email)->where('id', '!=', $customer->id)->exists()) {
            return back()->with('error', 'Email already exists.');
        }
        $iconPath = $customer->icon;
        if ($request->hasFile('icon')) {
            if ($customer->icon) {
                Storage::disk('public')->delete($customer->icon);
            }
            $iconPath = $request->file('icon')->store('customer_icons', 'public');
        }
        $customer->update([
            'display_name' => $request->display_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'icon' => $iconPath,
            'birthday' => $request->birthday ? date('Y-m-d', strtotime($request->birthday)) : null,
        ]);
        return redirect()->route('getProfile')->with('success', 'Customer updated successfully.');
    }
    public function changePassword(Request $request){
        $currentPass = $request->currentPass;
        $newPass= $request->newPass;
        $newPassre= $request->newPassrepeat;
        $customer= auth()->guard('client')->user();
        if(!Hash::check($currentPass,$customer->password)){
            return back()->with('error','Current Password is invalid');
        }
        if($newPass != $newPassre){
            return back()->with('error','Re-enter password not match');
        }
        if(str($newPass)->length <8){
             return back()->with('error','Password need at least 8 character');
        }
        $customer->update([
            'password' => Hash::make($newPass)
        ]);
        return back()->with('success', 'Password Changed !');
    }
}
