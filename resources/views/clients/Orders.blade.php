@extends('clients.layouts.master')
@section('main-content')
<div class="w-full">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">My Orders</h1>
    <div class="bg-white p-6 rounded-xl shadow-sm">
        @if($orders->isEmpty())
            <p class="text-gray-600">You have no orders yet.</p>
        @else
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center mb-4">
                        <h2 class="text-xl font-semibold mb-2">Order #{{ $order->id }}</h2>
                        <a style="margin-left: auto;"><i class="fa-solid fa-eye"></i></a>
                        </div>
                        <p class="text-gray-600 mb-4">Placed on {{ $order->created_at->format('F j, Y') }}</p>
                        <div class="space-y-2">
                            @foreach($order->orderdetails as $detail)
                                <div class="flex items-center">
                                    <img src="{{ asset ( 'storage/' . $detail->subproduct->thumbnail_path) }}" alt="{{ $detail->subproduct->name }}" class="w-16 h-16 object-cover rounded-md">
                                    <span>{{ $detail->subproduct->name }} (x{{ $detail->quantity }})</span>
                                    <span style="margin-left: auto;">${{ number_format($detail->total,0, ',', '.') }}đ</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection