<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Customer;
new class extends Component {
    use WithPagination;

    public string $search = '';
    public string $sortBy = 'id';
    public string $sortDir = 'asc';

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir === 'asc') ? 'desc' : 'asc';
        } else {
            $this->sortBy = $sortByField;
            $this->sortDir = 'asc';
        }
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function with(): array
    {
        return [
            'customers' => Customer::where('display_name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate(10),
        ];
    }
};
?>

<div>
    <div class="mb-4">
        <input type="text" wire:model.live="search" placeholder="Search customers..."
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
    <div class="main-container">
        <table class="table-auto w-full text-left rtl:text-right text-body">
            <thead class="border-default">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium whitespace-nowrap cursor-pointer" wire:click="setSortBy('id')">ID @if($sortBy === 'id')<i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>@endif</th>
                    <th scope="col" class="px-6 py-3 font-medium long whitespace-nowrap cursor-pointer" wire:click="setSortBy('display_name')">Name @if($sortBy === 'display_name')<i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>@endif</th>
                    <th scope="col" class="px-6 py-3 font-medium whitespace-nowrap cursor-pointer" wire:click="setSortBy('gender')">Gender @if($sortBy === 'gender')<i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>@endif</th>
                    <th scope="col" class="px-6 py-3 font-medium whitespace-nowrap cursor-pointer" wire:click="setSortBy('email')">Email @if($sortBy === 'email')<i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>@endif</th>
                    <th scope="col" class="px-6 py-3 font-medium whitespace-nowrap cursor-pointer" wire:click="setSortBy('phone')">Phone @if($sortBy === 'phone')<i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>@endif</th>
                    <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($customers) > 0)
                    @foreach ($customers as $customer)
                        <tr scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            <th class="px-6 py-4">
                                {{ $customer->id }}
                            </th>
                            <td class="px-6 py-4" style="color: black"> {{ $customer->display_name }}</td>
                            <td class="px-6 py-4" style="color: black"> {{ $customer->gender }}</td>
                            <td class="px-6 py-4" style="color: black"> {{ $customer->email }}</td>
                            <td class="px-6 py-4" style="color: black"> {{ $customer->phone }}</td>
                            <td class="px-6 py-4">
                                <form method="post" action="{{ route('customers.destroy', $customer->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn edit icon-only" href="{{ route('customers.edit', $customer->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <button class="btn delete icon-only"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center">No customer found.</td>
                    </tr>
                @endif
            </tbody>
            <tfoot>
                <tr style="border: 0;">
                    <td colspan="6" class="pt-4"> {{ $customers->links() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
