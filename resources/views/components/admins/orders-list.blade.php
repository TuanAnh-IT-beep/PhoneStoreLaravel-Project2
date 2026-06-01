<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;
new class extends Component {
    use WithPagination;

    public string $search = '';

    public $statuses = [
        -1 => ['text' => 'Cancelled', 'color' => 'text-red-500'],
        0 => ['text' => 'Pending', 'color' => 'text-yellow-500'],
        1 => ['text' => 'Confirmed', 'color' => 'text-green-500'],
        2 => ['text' => 'Shipping', 'color' => 'text-blue-500'],
        3 => ['text' => 'Delivered', 'color' => 'text-green-500'],
        4 => ['text' => 'Completed', 'color' => 'text-green-500'],
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function with(): array
    {
        return [
            'orders' => Order::with(['customer', 'payment', 'orderdetails'])
                ->where('receiver', 'like', '%' . $this->search . '%')
                ->orWhere('phone', 'like', '%' . $this->search . '%')
                ->orWhere('address', 'like', '%' . $this->search . '%')
                ->orderBy('id', 'asc')
                ->paginate(10),
        ];
    }
};
?>


<div>
    <div class="mb-4">
        <input type="text" wire:model.live="search" placeholder="Search orders..."
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
    <div class="main-container">
        <table class="table-auto w-full text-left rtl:text-right text-body">
            <thead class="border-default">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">ID</th>
                    <th scope="col" class="px-6 py-3 font-medium">Receiver</th>
                    <th scope="col" class="px-6 py-3 font-medium">Phone</th>
                    <th scope="col" class="px-6 py-3 font-medium">Items</th>
                    <th scope="col" class="px-6 py-3 font-medium">Total</th>
                    <th scope="col" class="px-6 py-3 font-medium">Status</th>
                    <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($orders) > 0)
                    @foreach ($orders as $order)
                        <tr scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            <th class="px-6 py-4">
                                {{ $order->id }}
                            </th>
                            <td class="px-6 py-4" style="color: black">
                                {{ $order->receiver }}
                            </td>
                            <td class="px-6 py-4" style="color: black">
                                {{ $order->phone }}
                            </td>
                            <td class="px-6 py-4" style="color: black">
                                {{ count($order->orderdetails) }}
                            </td>
                            <td class="px-6 py-4" style="color: black">
                                {{ number_format($order->total_price, 0, ',', '.') }}đ
                            </td>
                            <td class="px-6 py-4">
                                <span class="{{ $statuses[$order->status]['color'] }}">
                                    {{ $statuses[$order->status]['text'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4" style="color: black">
                                <a class="btn edit icon-only" href="{{ route('orders.show', $order->id) }}">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center">No order found.</td>
                    </tr>
                @endif
            </tbody>
            <tfoot>
                <tr style="border: 0;">
                    <td colspan="7" class="pt-4"> {{ $orders->links() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

</div>
