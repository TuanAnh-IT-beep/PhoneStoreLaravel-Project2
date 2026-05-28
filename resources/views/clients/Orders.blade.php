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
@section('main-content')
    <div class="w-full">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">My Orders</h1>
        <div class="bg-white p-6 rounded-xl shadow-sm">
            @if ($orders->isEmpty())
                <p class="text-gray-600">You have no orders yet.</p>
            @else
                <div class="space-y-6">
                    @foreach ($orders->sortByDesc('created_at') as $order)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center mb-4">
                                <h2 class="text-xl font-semibold mb-2">Order #{{ $order->id }}</h2>
                                <p
                                    class="ml-4 px-3 py-1 rounded-full text-sm font-medium {{ $statuses[$order->status] === 'Cancelled' ? 'bg-red-100 text-red-800' : ($statuses[$order->status] === 'Completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ $statuses[$order->status] }}
                                </p>
                                {{-- <a style="margin-left: auto;"><i class="fa-solid fa-eye"></i></a> --}}
                            </div>
                            <p class="text-gray-600 mb-4">Placed on {{ $order->created_at->format('F j, Y') }}</p>
                            <div class="space-y-2">
                                @foreach ($order->orderdetails as $detail)
                                    <div class="flex items-center">
                                        <img src="{{ asset('storage/' . $detail->subproduct->thumbnail_path) }}"
                                            alt="{{ $detail->subproduct->name }}" class="w-16 h-16 object-cover rounded-md">
                                        <span>{{ $detail->subproduct->name }} (x{{ $detail->quantity }})</span>
                                        <span
                                            style="margin-left: auto;">${{ number_format($detail->total, 0, ',', '.') }}đ</span>
                                    </div>
                                @endforeach
                            </div>
                            @if ($order->status == 0)
                                <div class="w-full flex justify-end mt-4">
                                    <button type="submit" class="btn icon-only" onclick="toggleModal('{{ route('order.cancel', $order->id) }}')">CANCEL
                                        ORDER</button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    
    <div id="cancelModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;">

        <div
            class="bg-white rounded-[2.5rem] p-8 md:p-12 shadow-2xl max-w-md w-full mx-4 text-center border border-gray-100 flex flex-col items-center">

            <div class="flex justify-center mb-8">
                <div class="bg-[#1e293b] w-20 h-20 rounded-full flex items-center justify-center shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <h3 class="text-xl md:text-2xl font-bold text-gray-900 leading-tight mb-10">
                Are You Sure You Want To Cancel This Order?
            </h3>

            <div class="flex flex-row justify-between gap-4 w-full">
                <button type="button" onclick="toggleModal()"
                    class="py-4 bg-[#c4c4c4] text-gray-800 font-bold text-lg rounded-full hover:bg-gray-400 transition-colors border-0"
                    style="width:100px">
                    Close
                </button>
                <form action="" method="GET" id="cancelForm">
                    @csrf
                    @method('GET')
                    <button type="submit"
                        class=" py-4 bg-[#ff2d20] font-bold text-lg rounded-full hover:bg-red-700 shadow-md transition-all border-0"
                        style="width:100px">
                        Cancel
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function toggleModal(actionUrl = null) {
            const modal = document.getElementById('cancelModal');
            const form = document.getElementById('cancelForm');

            if (modal.style.display === 'none' || modal.style.display === '') {
                if (actionUrl) form.action = actionUrl;
                modal.style.display = 'flex'; 
            } else {
                modal.style.display = 'none';
            }
        }
    </script>
@endsection
