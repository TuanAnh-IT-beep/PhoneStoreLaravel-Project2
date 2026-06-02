<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Subproduct;
new class extends Component {
    use WithPagination;

    public $product;
    public function mount($product)
    {
        $this->product = $product;
    }
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
            'subproducts' => Subproduct::where('name', 'like', '%' . $this->search . '%')
                ->where('product_id', $this->product->id)
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate(10),
        ];
    }
};
?>

<div>
    <div class="mb-4">
        <input type="text" wire:model.live="search" placeholder="Search products..."
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
    <div class="main-container">
        <table class="table-auto w-full text-left rtl:text-right text-body">
            <thead class="border-default">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium whitespace-nowrap cursor-pointer" wire:click="setSortBy('id')">ID @if($sortBy === 'id')<i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>@endif</th>
                    <th scope="col" class="px-6 py-3 font-medium">Thumbnail</th>
                    <th scope="col" class="px-6 py-3 font-medium whitespace-nowrap cursor-pointer" wire:click="setSortBy('name')">Name @if($sortBy === 'name')<i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>@endif</th>
                    <th scope="col" class="px-6 py-3 font-medium whitespace-nowrap cursor-pointer" wire:click="setSortBy('price')">Price @if($sortBy === 'price')<i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>@endif</th>
                    <th scope="col" class="px-6 py-3 font-medium whitespace-nowrap cursor-pointer" wire:click="setSortBy('stock')">Stock @if($sortBy === 'stock')<i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>@endif</th>
                    <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($subproducts) > 0)
                    @foreach ($subproducts as $subproduct)
                        <tr scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            <th class="px-6 py-4">
                                {{ $subproduct->id }}
                            </th>
                            <td class="px-6 py-4">
                                @if ($subproduct->thumbnail_path)
                                    <img src="{{ asset('storage/' . $subproduct->thumbnail_path) }}"
                                        alt="{{ $subproduct->name }}" class="w-16 h-16 object-cover border rounded">
                                @else
                                    <span class="text-gray-400 text-sm">No image</span>
                                @endif
                            </td>
                            <td class="px-6 py-4" style="color: black">
                                {{ $subproduct->name }}
                            </td>
                            <td class="px-6 py-4" style="color: black">
                                {{ number_format($subproduct->price, 0, ',', '.') }}đ
                            </td>
                            <td class="px-6 py-4" style="color: black">
                                {{ $subproduct->stock }}
                            </td>
                            <td class="px-6 py-4">
                                <form method="post"
                                    action="{{ route('subproducts.destroy', [$product->id, $subproduct->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn edit icon-only"
                                        href="{{ route('subproducts.edit', [$product->id, $subproduct->id]) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <button class="btn delete icon-only"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center">No subproduct found.</td>
                    </tr>
                @endif
            </tbody>
            <tfoot>
                <tr style="border: 0;">
                    <td colspan="5" class="pt-4"> {{ $subproducts->links() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
