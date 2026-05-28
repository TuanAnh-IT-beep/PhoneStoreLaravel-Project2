<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentMethod;

class OrderController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['customer', 'payment', 'orderdetails'])->get();

        return view('admins.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $cart = session()->get('cart', []);
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'receiver' => $request->receiver,
            'address' => $request->address,
            'phone' => $request->phone,
            'payment_method_id' => $request->payment,
            'note' => $request->note,
            'total_price' => $request->total_price,
            'status' => $request->status,
        ]);
        foreach ($cart as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'subproduct_id' => $item['id'],
                'quantity' => $item['stock'],
                'total' => $item['price'] * $item['stock'],
            ]);
        }
        session()->forget('cart');
        return redirect()->route('orders')->with('success', 'Order placed successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load(['customer', 'payment', 'orderdetails']);
        return view('admins.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {

        $status = $order->status;
        if ($status >= 0 && $status < 3) {
            $order->update([
                'status' => $status+1,
            ]);
        }
        return redirect()->route('orders.show', $order->id)->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    public function showinClient()
    {
        $orders = Order::where('customer_id', auth()->guard('client')->id())->with('orderdetails')->get();

        return view('clients.Orders', compact('orders'));
    }

    public function orderConfirm()
    {
        $client = Customer::find(auth()->guard('client')->id());
        $payment = PaymentMethod::all();
        $cart = session()->get('cart', []);
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['stock'];
        }
        $totalPrice += 40000;

        return view('clients.orderConfirm', compact('client', 'payment', 'cart', 'totalPrice'));
    }
    public function OrderCancel(UpdateOrderRequest $request, Order $order)
    {

        $status = $order->status;
        if ($status == 0 ) {
            $order->update([
                'status' => -1,
            ]);
        }
        return redirect()->route('orders', $order->id)->with('success', 'Order updated successfully.');
    }
}
