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
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
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
        $query = Subproduct::query();

        if (isset($this->id)) {
            $query->whereHas('product', function ($q) {
                $q->where('id', $this->id);
            });
        } elseif (isset($this->cateid)) {
            $query->whereHas('product', function ($q) {
                $q->where('category_id', $this->cateid);
            });
        }
        if (!empty($this->search)) {
            $query->where(function ($mainQuery) {
                $mainQuery
                    ->whereHas('product', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('sub_specs', function ($q) {
                        $q->where('value', 'like', '%' . $this->search . '%');
                    })
                    ->orWhere('price', 'like', '%' . $this->search . '%');
            });
        }

        return [
            'subproducts' => $query->paginate(10),
        ];
    }
};
?>

<div>
    <div class="mb-4">
        <input type="text" wire:model.live="search" placeholder="Search subproducts..."
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
    <div class="main-container">
        <table class="table-auto w-full text-left rtl:text-right text-body">
            <thead class="border-default">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium whitespace-nowrap cursor-pointer"
                        wire:click="setSortBy('id')"># @if ($sortBy === 'id')
                            <i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">Thumbnail</th>
                    <th scope="col" class="px-6 py-3 font-medium">Name</th>
                    <th scope="col" class="px-6 py-3 font-medium whitespace-nowrap cursor-pointer"
                        wire:click="setSortBy('price')">Price @if ($sortBy === 'price')
                            <i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium whitespace-nowrap cursor-pointer"
                        wire:click="setSortBy('stock')">Stock @if ($sortBy === 'stock')
                            <i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($subproducts) > 0)
                    @foreach ($subproducts as $subproduct)
                        <tr scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            <th class="px-6 py-4">
                                {{ $subproducts->firstItem() + $loop->index }} </th>
                            <td class="px-6 py-4">
                                @if ($subproduct->thumbnail_path)
                                    <img src="{{ asset('storage/' . $subproduct->thumbnail_path) }}"
                                        alt="{{ $subproduct->name() }}" class="w-16 h-16 object-cover border rounded">
                                @else
                                    <span class="text-gray-400 text-sm">No image</span>
                                @endif
                            </td>
                            <td class="px-6 py-4" style="color: black">
                                {{ $subproduct->name() }}
                            </td>
                            <td class="px-6 py-4" style="color: black">
                                {{ number_format($subproduct->price, 0, ',', '.') }}đ
                            </td>
                            <td class="px-6 py-4" style="color: black">
                                {{ $subproduct->stock }}
                            </td>
                            <td class="px-6 py-4">
                                <form method="post"
                                    onsubmit="return confirm('Are you sure you want to delete this item?\nThis action cannot be undone.');"
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
