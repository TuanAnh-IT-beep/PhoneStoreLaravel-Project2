<?php

use Livewire\Component;
use App\Models\Customer;
use App\Models\Subproduct;

new class extends Component {
    public $payment_methods;
    public string $customer_search = '';
    public string $subproduct_search = '';
    public $selected_customer;
    public array $order_details = [];

    public function mount($payment_methods)
    {
        $this->payment_methods = $payment_methods;
    }

    public function selectCustomer($id)
    {
        $this->selected_customer = Customer::find($id);
    }
    public function unbindCustomer()
    {
        $this->selected_customer = null;
    }

    public function addSubproduct($id)
    {
        $subproduct = Subproduct::find($id);
        if ($subproduct) {
            $exists = false;
            foreach ($this->order_details as $key => $item) {
                if ($item['id'] == $id) {
                    $this->order_details[$key]['quantity']++;
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $this->order_details[] = [
                    'id' => $subproduct->id,
                    'name' => $subproduct->name,
                    'price' => $subproduct->price,
                    'quantity' => 1,
                    'stock' => $subproduct->stock,
                    'thumbnail_path' => $subproduct->thumbnail_path,
                ];
            }
        }
    }
    public function getTotalPriceProperty()
    {
        $total = 0;
        foreach ($this->order_details as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
    public function removeSubproduct($index)
    {
        unset($this->order_details[$index]);
        $this->order_details = array_values($this->order_details);
    }

    public function with()
    {
        return [
            'customers' => Customer::where('username', 'like', '%' . $this->customer_search . '%')
                ->orWhere('display_name', 'like', '%' . $this->customer_search . '%')
                ->orWhere('email', 'like', '%' . $this->customer_search . '%')
                ->orWhere('phone', 'like', '%' . $this->customer_search . '%')
                ->orderBy('id', 'asc')
                ->get(),
            'subproducts' => Subproduct::where('name', 'like', '%' . $this->subproduct_search . '%')->get(),
        ];
    }
};
?>

<div>
    <form method="post" action="{{ route('orders.store') }}">
        @csrf
        <div class="main-container">
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <div class="flex gap-1 items-center mb-3">
                        <label for="customer">Customer:
                            {{ $selected_customer ? $selected_customer->display_name : '' }}</label><br>
                        <input type="hidden" name="customer_id"
                            value="{{ $selected_customer ? $selected_customer->id : null }}">
                        <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="btn"
                            type="button">
                            SELECT CUSTOMER
                        </button>
                    </div>

                    <label for="receiver">Receiver Name:</label><br>
                    <input required class="my-3 w-full" type="text" name="receiver"
                        value="{{ $selected_customer ? $selected_customer->display_name : '' }}"
                        placeholder="Input receiver name here..."><br>
                    <label for="phone">Phone:</label><br>
                    <input required class="my-3 w-full" type="text" name="phone"
                        value="{{ $selected_customer ? $selected_customer->phone : '' }}"
                        placeholder="Input phone here..."><br>
                    <label for="payment_method_id">Payment Method:</label><br>
                    <select required class="my-3 w-full" name="payment_method_id">
                        <option value="">Select payment method</option>
                        @foreach ($payment_methods as $payment_method)
                            <option value="{{ $payment_method->id }}">{{ $payment_method->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-6">
                    <label for="address">Address:</label><br>
                    <textarea required class="my-3 w-full" rows="3" type="text" name="address" placeholder="Input address here...">{{ $selected_customer ? $selected_customer->address : '' }}</textarea><br>
                    <label for="note">Note:</label><br>
                    <textarea class="my-3 w-full" rows="3" type="text" name="note" placeholder="Input note here..."></textarea><br>
                </div>
            </div>
        </div>
        <div class="main-container my-3">
            <div class="flex items-center justify-between mb-4">
                <h3>Order Details</h3>
                <button data-modal-target="subproduct-modal" data-modal-toggle="subproduct-modal" class="btn"
                    type="button">
                    <i class="fa-solid fa-plus"></i> ADD SUBPRODUCT
                </button>
            </div>

            <table class="table-auto w-full text-left rtl:text-right text-body">
                <thead class="border-default">
                    <tr>
                        <th class="px-6 py-3 font-medium">Subproduct</th>
                        <th class="px-6 py-3 font-medium">Price</th>
                        <th class="px-6 py-3 font-medium">Quantity</th>
                        <th class="px-6 py-3 font-medium">Total</th>
                        <th class="px-6 py-3 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($order_details as $index => $item)
                        <tr class="border-b border-default" wire:key="order-item-{{ $index }}">
                            <td class="px-6 py-4 flex items-center gap-2" style="color: black">
                                @if ($item['thumbnail_path'])
                                    <img src="{{ asset('storage/' . $item['thumbnail_path']) }}"
                                        alt="{{ $item['name'] }}" class="w-12 h-12 object-cover border rounded">
                                @endif
                                {{ $item['name'] }}
                                <input type="hidden" name="order_details[{{ $index }}][subproduct_id]"
                                    value="{{ $item['id'] }}">
                            </td>
                            <td class="px-6 py-4" style="color: black">
                                {{ number_format($item['price'], 0, ',', '.') }}đ</td>
                            <td class="px-6 py-4">
                                <input type="number" name="order_details[{{ $index }}][quantity]"
                                    wire:model.live="order_details.{{ $index }}.quantity" min="1"
                                    max="{{ $item['stock'] }}" class="w-20 px-2 py-1 border rounded"
                                    style="color: black;">
                            </td>
                            <td class="px-6 py-4" style="color: black">
                                {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ</td>
                            <td class="px-6 py-4">
                                <button type="button" wire:click="removeSubproduct({{ $index }})"
                                    class="btn delete icon-only"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center">No subproduct added.</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-right font-bold" style="color: black;">Subtotal:
                        </td>
                        <td class="px-6 py-4 font-bold" style="color: black;">
                            {{ number_format($this->total_price, 0, ',', '.') }}đ</td>
                        <input type="hidden" name="status" value="0">
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-right font-bold" style="color: black;">Fee:
                        </td>
                        <td class="px-6 py-4 font-bold" style="color: black;">
                            {{ number_format(40000, 0, ',', '.') }}đ</td>
                        <input type="hidden" name="status" value="0">
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-right font-bold" style="color: black;">Total:
                        </td>
                        <td class="px-6 py-4 font-bold" style="color: black;">
                            {{ number_format($this->total_price+40000, 0, ',', '.') }}đ</td>
                        <input type="hidden" name="status" value="0">
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <div class="mt-4 flex gap-2">
                <button type="submit" class="btn flex-1">CREATE ORDER</button>
                <a class="btn flex-1 negative" href="{{ route('orders.index') }}">CANCEL</a>
            </div>
        </div>
    </form>
    {{-- Customer selection modal --}}
    <div id="default-modal" tabindex="-1" aria-hidden="true" wire:ignore.self
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="fixed inset-0 bg-black/25 transition-opacity"></div>
        <div class="relative p-4 w-full max-w-4xl max-h-full">
            <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
                <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                    <h3 class="text-lg font-medium text-heading">
                        Select a Customer
                    </h3>
                    <div>
                        @if ($selected_customer)
                            <button type="button" wire:click="unbindCustomer()" data-modal-hide="default-modal"
                                class="btn">UNBIND</button>
                        @endif
                        <button type="button"
                            class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                            data-modal-hide="default-modal">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                </div>
                <div>
                    <input type="text" wire:model.live="customer_search" placeholder="Search customer..."
                        class="w-full px-4 py-2 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div class="max-h-60 overflow-y-auto">
                        <table class="table-auto w-full text-left rtl:text-right text-body">
                            <thead class="border-default">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-medium">ID</th>
                                    <th scope="col" class="px-6 py-3 font-medium">Name</th>
                                    <th scope="col" class="px-6 py-3 font-medium">Phone</th>
                                    <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $customer)
                                    <tr class="border-b border-default" wire:key="customer-{{ $customer->id }}">
                                        <td class="px-6 py-4">{{ $customer->id }}</td>
                                        <td class="px-6 py-4" style="color: black">{{ $customer->display_name }}</td>
                                        <td class="px-6 py-4" style="color: black">{{ $customer->phone }}</td>
                                        <td class="px-6 py-4">
                                            <button type="button" wire:click="selectCustomer({{ $customer->id }})"
                                                data-modal-hide="default-modal" class="btn">Select</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center">No customer found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Subproduct selection modal --}}
    <div id="subproduct-modal" tabindex="-1" aria-hidden="true" wire:ignore.self
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="fixed inset-0 bg-black/25 transition-opacity"></div>
        <div class="relative p-4 w-full max-w-4xl max-h-full">
            <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
                <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                    <h3 class="text-lg font-medium text-heading">
                        Select a Subproduct
                    </h3>
                    <button type="button"
                        class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="subproduct-modal">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="pt-4">
                    <input type="text" wire:model.live="subproduct_search" placeholder="Search subproduct..."
                        class="w-full px-4 py-2 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div class="max-h-60 overflow-y-auto">
                        <table class="table-auto w-full text-left rtl:text-right text-body">
                            <thead class="border-default">
                                <tr>
                                    <th class="px-6 py-3 font-medium">Image</th>
                                    <th class="px-6 py-3 font-medium">Name</th>
                                    <th class="px-6 py-3 font-medium">Price</th>
                                    <th class="px-6 py-3 font-medium">Stock</th>
                                    <th class="px-6 py-3 font-medium">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subproducts as $subproduct)
                                    <tr class="border-b border-default" wire:key="subproduct-{{ $subproduct->id }}">
                                        <td class="px-6 py-4">
                                            @if ($subproduct->thumbnail_path)
                                                <img src="{{ asset('storage/' . $subproduct->thumbnail_path) }}"
                                                    alt="{{ $subproduct->name }}"
                                                    class="w-12 h-12 object-cover border rounded">
                                            @else
                                                <span class="text-gray-400 text-sm">No image</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-black">{{ $subproduct->name }}</td>
                                        <td class="px-6 py-4 text-black">
                                            {{ number_format($subproduct->price, 0, ',', '.') }}đ</td>
                                        <td class="px-6 py-4 text-black">{{ $subproduct->stock }}</td>
                                        <td class="px-6 py-4">
                                            <button type="button" wire:click="addSubproduct({{ $subproduct->id }})"
                                                class="btn">Add</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center">No subproduct found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
