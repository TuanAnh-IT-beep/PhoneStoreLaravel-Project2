<?php
$statuses = [
    -1 => 'Cancelled',
    0 => 'Pending',
    1 => 'Confirmed',
    2 => 'Shipping',
    3 => 'Delivered',
    4 => 'Completed',
];
?>
@extends('clients.layouts.master')
@section('title', 'My Orders')
@section('main-content')
    <div class="main-content">
        <div>
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <h1 class="text-3xl font-bold text-gray-800">My Orders</h1>
                @if ($orders->isNotEmpty())
                    <form method="GET" action="" class="flex items-center gap-2">
                        <label for="sort" class="text-sm font-medium text-gray-700 whitespace-nowrap">Sort by:</label>
                        <select name="sort" id="sort" onchange="this.form.submit()" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white text-gray-700 text-sm">
                            <option value="created_at_desc" {{ request('sort') == 'created_at_desc' ? 'selected' : '' }}>Newest First</option>
                            <option value="created_at_asc" {{ request('sort') == 'created_at_asc' ? 'selected' : '' }}>Oldest First</option>
                            <option value="total_price_desc" {{ request('sort') == 'total_price_desc' ? 'selected' : '' }}>Most Expensive</option>
                            <option value="total_price_asc" {{ request('sort') == 'total_price_asc' ? 'selected' : '' }}>Least Expensive</option>
                            <option value="status_desc" {{ request('sort') == 'status_desc' ? 'selected' : '' }}>Descending Status</option>
                            <option value="status_asc" {{ request('sort') == 'status_asc' ? 'selected' : '' }}>Ascending Status</option>
                        </select>
                    </form>
                @endif
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                @if ($orders->isEmpty())
                    <div class="flex flex-col items-center justify-center py-12 text-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fa-solid fa-box-open text-3xl text-gray-400"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800 mb-2">No Orders Yet</h2>
                        <p class="text-gray-500 mb-6">Looks like you haven't placed any orders.</p>
                        <a href="{{ route('home') }}" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition">Start Shopping</a>
                    </div>
                @else
                    <div class="space-y-8">
                        @php
                            $sortBy = request('sort', 'created_at_desc');
                            $sortedOrders = match($sortBy) {
                                'total_price_asc' => $orders->sortBy('total_price'),
                                'total_price_desc' => $orders->sortByDesc('total_price'),
                                'status_asc' => $orders->sortBy('status'),
                                'status_desc' => $orders->sortByDesc('status'),
                                'created_at_asc' => $orders->sortBy('created_at'),
                                default => $orders->sortByDesc('created_at'),
                            };
                        @endphp
                        @foreach ($sortedOrders as $order)
                            @php
                                $statusColor = match($order->status) {
                                    -1 => 'bg-red-100 text-red-700 border border-red-200',
                                    0 => 'bg-yellow-100 text-yellow-700 border border-yellow-200',
                                    1 => 'bg-blue-100 text-blue-700 border border-blue-200',
                                    2 => 'bg-indigo-100 text-indigo-700 border border-indigo-200',
                                    3, 4 => 'bg-green-100 text-green-700 border border-green-200',
                                    default => 'bg-gray-100 text-gray-700 border border-gray-200',
                                };
                            @endphp
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                <div class="bg-gray-50 p-5 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                    <div>
                                        <div class="flex items-center gap-3 mb-1">
                                            <h2 class="text-lg font-bold text-gray-800">Order #{{ $order->id }}</h2>
                                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $statusColor }}">{{ $statuses[$order->status] }}</span>
                                        </div>
                                        <p class="text-sm text-gray-500">Placed on <span class="font-medium text-gray-700">{{ $order->created_at->format('F j, Y, g:i a') }}</span></p>
                                    </div>
                                    <div class="text-left sm:text-right">
                                        <p class="text-sm text-gray-500 mb-1">Total Amount</p>
                                        <p class="text-xl font-bold text-red-500">{{ number_format($order->total_price, 0, ',', '.') }}đ</p>
                                    </div>
                                </div>
                                <div class="p-5 space-y-4">
                                    @foreach ($order->orderdetails as $detail)
                                        <div class="flex items-center gap-4 border-b border-gray-100 last:border-0 pb-4 last:pb-0">
                                            <div class="w-16 h-16 shrink-0 bg-gray-50 rounded-lg border border-gray-200 p-1">
                                                <img src="{{ asset('storage/' . $detail->subproduct->thumbnail_path) }}" alt="{{ $detail->subproduct->name() }}" class="w-full h-full object-cover rounded">
                                            </div>
                                            <div class="grow">
                                                <h3 class="font-semibold text-gray-800 text-sm md:text-base">{{ $detail->subproduct->name() }}</h3>
                                                <p class="text-gray-500 mt-1" style="font-size: 1rem">Qty: <span class="font-medium">{{ $detail->quantity }}</span></p>
                                            </div>
                                            <div class="text-right font-bold text-gray-700">
                                                {{ number_format($detail->total, 0, ',', '.') }}đ
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if ($order->status == 0)
                                    <div class="bg-gray-50 p-4 border-t border-gray-200 flex justify-end">
                                        <form action="{{ route('order.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn delete flex items-center">
                                                <i class="fa-solid fa-xmark"></i> Cancel Order
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
