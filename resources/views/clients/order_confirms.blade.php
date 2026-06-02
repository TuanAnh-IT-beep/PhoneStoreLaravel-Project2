@extends('clients.layouts.master')
@section('title', 'Order Confirmation')
@section('main-content')
    <div class="main-content">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Order Confirmation</h1>
        <form action="{{ route('order.confirm') }}" method="POST">
            @csrf
            <input type="hidden" name="customer_id" value="{{ Auth::guard('client')->user()->id }}">
            <input type="hidden" name="total_price" value="{{ $totalPrice }}">
            <input type="hidden" name="status" value="0">

            <div class="grid grid-cols-12 gap-8 mt-4">
                <div class="col-span-8">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 mb-6 border-b pb-4">Shipping information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="receiver" class="block text-sm font-semibold text-gray-700 mb-2">Receiver Name</label>
                                <input type="text" name="receiver" id="receiver" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow" value="{{ Auth::guard('client')->user()->display_name }}" required>
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                                <input type="text" name="phone" id="phone" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow" value="{{ Auth::guard('client')->user()->phone }}" required>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Delivery Address</label>
                            <input type="text" name="address" id="address" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow" value="{{ Auth::guard('client')->user()->address }}" required>
                        </div>

                        <div class="mb-6">
                            <label for="payment" class="block text-sm font-semibold text-gray-700 mb-2">Payment Method</label>
                            <select name="payment" id="payment" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow" required>
                                @foreach ($payment as $pay)
                                    <option value="{{ $pay->id }}">{{ $pay->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-6">
                            <label for="note" class="block text-sm font-semibold text-gray-700 mb-2">Additional Notes</label>
                            <textarea name="note" id="note" rows="4" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow" placeholder="Any special requests or instructions for delivery..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-span-4">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 sticky top-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6 border-b pb-4">Order summary</h2>
                        <div class="max-h-80 overflow-y-auto mb-6 pr-2 custom-scrollbar">
                            @foreach ($cart as $id => $item)
                                <div class="flex items-center gap-4 mb-4 pb-4 border-b border-gray-100 last:border-0 last:mb-0 last:pb-0">
                                    <div class="w-16 h-16 shrink-0 bg-gray-50 rounded-md border border-gray-200 p-1">
                                        <img src="{{ asset('storage/' . $item['thumbnail_path']) }}" alt="Product" class="w-full h-full object-cover rounded">
                                    </div>
                                    <div class="grow">
                                        <h3 class="text-sm font-bold text-gray-800 leading-tight mb-1">{{ $item['name'] }}</h3>
                                        <div class="flex justify-between items-center text-sm">
                                            <span class="text-gray-500">Qty: {{ $item['stock'] }}</span>
                                            <span class="font-semibold text-gray-700">{{ number_format($item['price'] * $item['stock'], 0, ',', '.') }}đ</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="space-y-3 text-sm text-gray-600 mb-6 border-t pt-4">
                            <div class="flex justify-between">
                                <span class="font-semibold">Subtotal</span>
                                <span class="font-medium text-gray-800">{{ number_format($totalPrice - 40000, 0, ',', '.') }}đ</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Shipping Fee</span>
                                <span class="font-medium text-gray-800">40.000đ</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center mb-6 pt-4 border-t border-gray-200">
                            <span class="text-lg font-bold text-gray-800">Total</span>
                            <span class="text-xl font-bold text-red-500">{{ number_format($totalPrice, 0, ',', '.') }}đ</span>
                        </div>

                        <div class="flex flex-col gap-3">
                            <button type="submit" class="w-full btn icon-only create">
                                PLACE
                            </button>
                            <a href="{{ route('cart') }}" class="w-full btn icon-only">
                                BACK
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
