<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentMethod;
use App\Models\Subproduct;
use Carbon\Carbon;

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
    public function create()
    {
        $payment_methods = PaymentMethod::all();

        return view('admins.orders.create', compact('payment_methods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $total_price = 0;
        foreach ($request->order_details as $item) {
            $subproduct = Subproduct::find($item['subproduct_id']);
            if ($subproduct->stock < $item['quantity']) {
                return back()->with('error', 'One of the subproducts has insufficient stock.');
            }
            if ($subproduct) {
                $total_price += $subproduct->price * $item['quantity'];
            }
        }
        $total_price += 40000;
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'receiver' => $request->receiver,
            'address' => $request->address,
            'phone' => $request->phone,
            'payment_method_id' => $request->payment_method_id,
            'note' => $request->note,
            'status' => $request->status,
            'ship_fee' => 40000,
            'total_price' => $total_price,
            'ship_expect_date' => Carbon::now()->addDays(3)->toDateTimeString(),
        ]);
        if ($request->has('order_details')) {
            foreach ($request->order_details as $item) {
                $subproduct = Subproduct::find($item['subproduct_id']);
                if ($subproduct) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'subproduct_id' => $subproduct->id,
                        'quantity' => $item['quantity'],
                        'total' => $subproduct->price * $item['quantity'],
                    ]);
                    $subproduct->update(['stock' => $subproduct->stock - $item['quantity']]);
                }
            }
        }
        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function placeOrder(StoreOrderRequest $request)
    {
        $cart = session()->get('cart', []);
        foreach ($cart as $item) {
            $subproduct = Subproduct::find($item['id']);
            if ($subproduct->stock < $item['stock']) {
                return back()->with('error', 'One of the item in carts has insufficient stock.');
            }
        }
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'receiver' => $request->receiver,
            'address' => $request->address,
            'phone' => $request->phone,
            'payment_method_id' => $request->payment,
            'note' => $request->note,
            'ship_fee' => 40000,
            'total_price' => $request->total_price,
            'status' => $request->status,
            'ship_expect_date' => Carbon::now()->addDays(3)->toDateTimeString(),
        ]);
        foreach ($cart as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'subproduct_id' => $item['id'],
                'quantity' => $item['stock'],
                'total' => $item['price'] * $item['stock'],
            ]);
            Subproduct::find($item['id'])->update(['stock' => Subproduct::find($item['id'])->stock - $item['stock']]);
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
                'status' => $status + 1,
                'user_id' => ($status == 0) ? auth('admin')->user()->id : $order->user_id,
                'ship_actual_date' => ($status+1 == 3) ? Carbon::now()->toDateTime() : $order->ship_actual_date,
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

        return view('clients.orders', compact('orders'));
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

        return view('clients.order_confirms', compact('client', 'payment', 'cart', 'totalPrice'));
    }
    public function OrderCancel(UpdateOrderRequest $request, $id)
    {
        $order = Order::findOrFail($id);
        $status = $order->status;
        if ($status == 0 ) {
            $order->update([
                'status' => -1,
            ]);
        }
        return redirect()->route('orders', $order->id)->with('success', 'Order updated successfully.');
    }
}
