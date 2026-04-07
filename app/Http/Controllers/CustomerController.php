<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class CustomerController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view("admins.customers.index", compact("customers"));
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
        Customer::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'icon' => $request->icon,
            'display_name' => $request->display_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'birthday' => date('Y-m-d',strtotime($request->birthday)),
            'address' => $request->address
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
                'customer' => $customer
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update([
            'username' => $request->username,
            'icon' => $request->icon,
            'display_name' => $request->display_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'address' => $request->address
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
        return view('clients.login');
    }

    public function loginProcess(Request $request)
    {
        if (Auth::guard('client')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Login successful.');
        } else {
            return Redirect::back();
        }
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
