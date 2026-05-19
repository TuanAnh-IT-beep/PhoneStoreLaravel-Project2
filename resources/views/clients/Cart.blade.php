@extends('clients.layouts.master')

@section('main-content')
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Your Cart</h1>
    <div style="marign-top: 5px;">
        @if(empty($cart))
            <div class="flex flex-col items-center justify-center gap-4"
                style="background-color: #fafafadc; border-radius: 12px; padding: 40px; border: 1px solid #e5e7eb;">
                <i class="fa-solid fa-cart-shopping text-gray-400 text-4xl"></i>
                <p class="text-gray-600">Your cart is currently empty.</p>
            </div>
        @else
            @foreach ($cart as $id => $item)
                <div class="w-full p-6 relative flex items-center gap-6"
                    style="background-color: #fafafadc; border-radius: 12px; margin-top: 10px; border: 1px solid #e5e7eb;">
                    <div class="absolute top-2 left-3 cursor-pointer hover:text-red-500 transition-colors">
                        <a href="{{ route('remove', $item['id']) }}">
                            <i class="fa-solid fa-xmark text-gray-400 text-xs"></i>
                        </a>
                    </div>
                    <div class="w-24 h-24 shrink-0">
                        <img src="{{ asset('storage/' . $item['thumbnail_path']) }}" alt="Product"
                            class="w-full h-full object-cover rounded-lg">
                    </div>
                    <div class="grow flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="grow">
                            <h3 class="text-lg font-bold text-gray-800 leading-tight">{{ $item['name'] }}</h3>
                        </div>
                        <div class="text-left md:text-right min-w-[120px]">
                            <p class="text-xs text-gray-400">{{ number_format($item['price'] * $item['stock'], 0, ',', '.') }}đ</p>
                        </div>
                        <div class="flex items-center border border-gray-300 rounded-lg w-25 bg-white">
                            <button class="px-3 py-1 hover:bg-gray-100 border-r border-gray-300"><a
                                    href="{{ route('minus', $item['id']) }}">-</a></button>
                            <input type="text" value="{{ $item['stock'] }}"
                                class="w-11 text-center text-sm font-bold focus:outline-none" readonly>
                            <button class="px-3 py-1 hover:bg-gray-100 border-l border-gray-300"><a
                                    href="{{ route('plus', $item['id']) }}">+</a></button>
                        </div>
                    </div>
                </div>
            @endforeach
            @php
                $total = 0;
                foreach ($cart as $id => $item) {
                    $total += $item['price'] * $item['stock'];
                }
            @endphp
            <p style=" margin-top: 10px;">Tổng: {{ number_format($total, 0, ',', '.') }}đ</p>
            <div class="flex justify-end mt-6">
                <button class="bg-red-300 text-gray-700 px-4 py-2 rounded-md mr-2 hover:bg-gray-400 transition-colors">
                    <a href="{{ route('removeall') }}">
                        Xóa giỏ hàng
                    </a>
                </button>
                <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md mr-2 hover:bg-gray-400 transition-colors">
                    <a href="{{ route('home') }}" style="color: white;">
                        Tiếp tục mua hàng
                    </a>
                </button>
                <button class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-colors">
                    <a href="{{ route('orderConfirm', Auth::guard('client')->user()->id) }}" class="block text-center"
                        style="color: white;">
                        Xác nhận đơn hàng
                    </a>
                </button>
            </div>
        @endif
@endsection