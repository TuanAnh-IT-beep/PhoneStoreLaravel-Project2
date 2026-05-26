<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Http\Requests\StorePaymentMethodRequest;
use App\Http\Requests\UpdatePaymentMethodRequest;
use Illuminate\Support\Facades\Redirect;

class PaymentMethodController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment_methods = PaymentMethod::all();
        return view("admins.payment_methods.index", compact("payment_methods"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.payment_methods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentMethodRequest $request)
    {
        PaymentMethod::create([
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $request->icon
        ]);
        return Redirect::route('admins.settings.index')->with('success', 'Payment method created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        return view('admins.payment_methods.edit', compact('paymentMethod'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentMethodRequest $request, PaymentMethod $paymentMethod)
    {
        $paymentMethod->update([
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $request->icon
        ]);
        return Redirect::route('admins.settings.index')->with('success', 'Payment method updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();
        return Redirect::route('admins.settings.index')->with('success', 'Payment method deleted successfully.');
    }
}
