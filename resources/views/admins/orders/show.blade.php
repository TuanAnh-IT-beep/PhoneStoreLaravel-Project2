<?php
$statuses = [
    -1 => ['text' => 'Cancelled', 'color' => 'text-red-500'],
    0 => ['text' => 'Pending', 'color' => 'text-yellow-500'],
    1 => ['text' => 'Confirmed', 'color' => 'text-green-500'],
    2 => ['text' => 'Shipping', 'color' => 'text-blue-500'],
    3 => ['text' => 'Delivered', 'color' => 'text-green-500'],
    4 => ['text' => 'Completed', 'color' => 'text-green-500'],
];
?>
@extends('admins.layouts.master')
@section('pageTitle', 'Orders')

@section('main-content')
    <div class="w-full flex mb-4 justify-between">
        <h1>Order Details: #{{ $order->id }}</h1>
    </div>
    <div class="main-container mb-4">
        <h3>Order ID: #{{ $order->id }}</h3>
        <div class="grid grid-cols-3 gap-6 my-3">
            <div class="col-span-1">
                <div class="order-details w-full h-full">
                    <div class="icon">
                        <i class="fa-solid fa-user fa-fw text-white" style="font-size:20px"></i>
                    </div>
                    <div>
                        <h3>Receiver</h3>
                        <p class="info mt-1">Full Name: {{ $order->receiver }}</p>
                        @if ($order->customer)
                            <p class="info mt-1">Ordered By: {{ $order->customer->display_name }}</p>
                        @endif
                        <p class="info mt-1">Phone: {{ $order->phone }}</p>
                    </div>
                </div>
            </div>
            <div class="col-span-1">
                <div class="order-details w-full h-full">
                    <div class="icon">
                        <i class="fa-solid fa-bag-shopping fa-fw text-white" style="font-size:20px"></i>
                    </div>
                    <div class="w-full">
                        <h3>Order Info</h3>
                        <div class="flex justify-between">
                            <div>
                                <p class="info mt-1">Status: <span
                                        class="{{ $statuses[$order->status]['color'] }}">{{ $statuses[$order->status]['text'] }}</span>
                                </p>
                                <p class="info mt-1">Payment Method: {{ $order->payment->name }}</p>
                                <p class="info mt-1">Ordered at: {{ $order->created_at }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-1">
                <div class="order-details w-full h-full">
                    <div class="icon">

                        <i class="fa-solid fa-map fa-fw text-white" style="font-size:20px"></i>
                    </div>
                    <div>
                        <h3>Address</h3>
                        <p class="info mt-1">Deliver to: {{ $order->address }}</p>
                    </div>
                </div>
            </div>
        </div>
        <label>Note</label>
        <textarea class="my-3 w-full" placeholder="No note." rows="6" readonly>{{ $order->note }}</textarea>
        @if ($order->status >= 0 && $order->status < 3)
            <div class="w-full flex justify-end">
                <form method="post" action="{{ route('orders.update', $order->id) }}">
                    @csrf
                    @method('put')
                    <button class="btn icon-only">CONFIRM </button>
                </form>
            </div>
        @endif
    </div>
    <div class="main-container">
        <h3>Product Placed</h3>
        <table class="table-auto w-full text-left rtl:text-right text-body mt-3">
            <thead class="border-default">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">#</th>
                    <th scope="col" class="px-6 py-3 font-medium">Thumbnail</th>
                    <th scope="col" class="px-6 py-3 font-medium long">Name</th>
                    <th scope="col" class="px-6 py-3 font-medium">Price</th>
                    <th scope="col" class="px-6 py-3 font-medium">Quantity</th>
                    <th scope="col" class="px-6 py-3 font-medium">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($order->orderdetails as $detail) {
                    $total += $detail->subproduct->price * $detail->quantity;
                }
                ?>
                @foreach ($order->orderdetails as $detail)
                    <tr scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                        <th class="px-6 py-4">
                            {{ $loop->index + 1 }}
                        </th>
                        <td class="px-6 py-4">
                            @if ($detail->subproduct->thumbnail_path)
                                <img src="{{ asset('storage/' . $detail->subproduct->thumbnail_path) }}"
                                    alt="{{ $detail->subproduct->name() }}" class="w-16 h-16 object-cover border rounded">
                            @else
                                <span class="text-gray-400 text-sm">No image</span>
                            @endif
                        </td>
                        <td class="px-6 py-4" style="color: black">
                            {{ $detail->subproduct->name() }}
                        </td>
                        <td class="px-6 py-4" style="color: black">
                            {{ number_format($detail->subproduct->price, 0, ',', '.') }}đ
                        </td>
                        <td class="px-6 py-4" style="color: black">
                            {{ $detail->quantity }}
                        </td>
                        <td class="px-6 py-4" style="color: black">
                            <p><b>
                                    {{ number_format($detail->subproduct->price * $detail->quantity, 0, ',', '.') }}đ
                                </b></p>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" class="px-6 py-4">
                        <p>Subtotal:</p>
                    </td>
                    <td class="px-6 py-4" style="color: black">
                        <p><b>{{ number_format($total, 0, ',', '.') }}đ</b></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="px-6 py-4">
                        <p>Fee:</p>
                    </td>
                    <td class="px-6 py-4" style="color: black">
                        <p><b>{{ number_format($order->ship_fee, 0, ',', '.') }}đ</b></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="px-6 py-4">
                        <p><b>Total:</b></p>
                    </td>
                    <td class="px-6 py-4" style="color: black">
                        <p><b>{{ number_format($order->total_price, 0, ',', '.') }}đ</b></p>
                    </td>
                </tr>
            </tbody>
    </div>
@endsection
