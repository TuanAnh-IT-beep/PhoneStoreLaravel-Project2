<?php

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    // Dynamically retrieve the cart from the session
    public function getCartProperty()
    {
        return Session::get('cart', []);
    }

    // Dynamically compute the total cost
    public function getTotalProperty()
    {
        $total = 0;
        foreach ($this->cart as $item) {
            $total += $item['price'] * $item['stock'];
        }
        return $total;
    }

    public function plus($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['stock']++;
            Session::put('cart', $cart);
        }
    }

    public function minus($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            if ($cart[$id]['stock'] > 1) {
                $cart[$id]['stock']--;
            } else {
                unset($cart[$id]);
            }
            Session::put('cart', $cart);
        }
    }

    public function remove($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
    }

    public function removeAll()
    {
        Session::forget('cart');
    }

    public function confirmOrder()
    {
        return redirect()->route('orderConfirm', Auth::guard('client')->user()->id);
    }
};
?>
<div>
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Your Cart</h1>
    <div style="margin-top: 5px;">
        <div class="grid grid-cols-12 gap-6 mt-4">
            <!-- Left Side: Cart Table & Actions -->
            <div class="col-span-9">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-sm">
                                <th class="p-4 font-semibold">#</th>
                                <th class="p-4 font-semibold long">Product</th>
                                <th class="p-4 font-semibold">Price</th>
                                <th class="p-4 font-semibold text-center">Quantity</th>
                                <th class="p-4 font-semibold">Total</th>
                                <th class="p-4"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @if (count($this->cart) > 0)
                                @foreach ($this->cart as $id => $item)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="p-4 text-gray-500">{{ $loop->index + 1 }}</td>
                                        <td class="p-4 flex items-center gap-4">
                                            <div class="w-16 h-16 shrink-0">
                                                <img src="{{ asset('storage/' . $item['thumbnail_path']) }}"
                                                    alt="Product"
                                                    class="w-full h-full object-cover rounded-md border border-gray-100">
                                            </div>
                                            <span class="font-semibold text-gray-800">{{ $item['name'] }}</span>
                                        </td>
                                        <td class="p-4 text-gray-600 font-semibold">
                                            {{ number_format($item['price'], 0, ',', '.') }}đ
                                        </td>
                                        <td class="p-4">
                                            <div
                                                class="flex items-center justify-center border border-gray-300 rounded-md w-max mx-auto bg-white">
                                                <button type="button" wire:click="minus('{{ $id }}')"
                                                    class="px-3 py-1 hover:bg-gray-100 border-r border-gray-300 transition">-</button>
                                                <input type="text" value="{{ $item['stock'] }}"
                                                    class="w-12 text-center text-sm font-bold focus:outline-none bg-transparent"
                                                    readonly>
                                                <button type="button" wire:click="plus('{{ $id }}')"
                                                    class="px-3 py-1 hover:bg-gray-100 border-l border-gray-300 transition">+</button>
                                            </div>
                                        </td>
                                        <td class="p-4 font-semibold text-gray-800">
                                            {{ number_format($item['price'] * $item['stock'], 0, ',', '.') }}đ
                                        </td>
                                        <td class="p-4">
                                            <button type="button" wire:click="remove('{{ $id }}')"
                                                class="btn delete ml-2 icon-only" title="Remove">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center p-4">No items in the cart.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Action Buttons beneath table -->
                <div class="flex justify-between items-center mt-3">
                    <a href="{{ route('home') }}" class="btn flex items-center gap-2">
                        <i class="fa-solid fa-arrow-left"></i> Continue shopping
                    </a>
                    @if (count($this->cart) > 0)
                        <button type="button" wire:click="removeAll" wire:confirm="Delete all items in cart?"
                            class="btn delete flex items-center gap-2">
                            <i class="fa-solid fa-trash-can"></i> Delete all
                        </button>
                    @endif
                </div>
            </div>

            <div class="col-span-3">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 border-b pb-4">Order Summary</h2>
                    <div class="flex justify-between text-gray-600 mb-4">
                        <span class="font-semibold">Subtotal</span>
                        <span class="font-medium">{{ number_format($this->total, 0, ',', '.') }}đ</span>
                    </div>
                    <div class="flex justify-between text-gray-600 mb-4">
                        <span>Shipping Fee</span>
                        <span class="font-medium">{{ count($this->cart) > 0 ? '40.000' : '0' }}đ</span>
                    </div>
                    <hr class="my-4 border-gray-200">
                    <div class="flex justify-between items-center mb-8">
                        <span class="text-lg font-bold text-gray-800">Total</span>
                        <span
                            class="text-xl font-bold text-red-500">{{ count($this->cart) > 0 ? number_format($this->total + 40000, 0, ',', '.') : '0' }}đ</span>
                    </div>
                    @if (count($this->cart) > 0)
                        <button type="button" wire:click="confirmOrder" class="btn icon-only w-full create">
                        CONFIRM
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
