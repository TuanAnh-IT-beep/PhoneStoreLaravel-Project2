<?php

use Livewire\Component;
use App\Models\Product;
new class extends Component {
    public string $search = '';

    public function with(): array
    {
        return [
            'products' => Product::with('category', 'manufacturer', 'subproducts')->where('name', 'like', '%' . $this->search . '%')
                ->orderBy('id', 'asc')
                ->get(),
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
                    <th scope="col" class="px-6 py-3 font-medium">ID</th>
                    <th scope="col" class="px-6 py-3 font-medium">Thumbnail</th>
                    <th scope="col" class="px-6 py-3 font-medium">Name</th>
                    <th scope="col" class="px-6 py-3 font-medium">Manufacturer</th>
                    <th scope="col" class="px-6 py-3 font-medium">Category</th>
                    <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($products) > 0)
                    @foreach ($products as $pro)
                        <tr scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            <th class="px-6 py-4">
                                {{ $pro->id }}
                            </th>
                            <td class="px-6 py-4">
                                @if($pro->thumbnail_path)
                                    <img src="{{ asset('storage/' . $pro->thumbnail_path) }}" alt="{{ $pro->name }}"
                                        class="w-16 h-16 object-cover border rounded">
                                @else
                                    <span class="text-gray-400 text-sm">No image</span>
                                @endif
                            </td>
                            <td class="px-6 py-4" style="color: black">
                                {{ $pro->name }}
                            </td>
                            <td class="px-6 py-4" style="color: black">
                                {{ $pro->manufacturer->name }}
                            </td>
                            <td class="px-6 py-4" style="color: black">
                                {{ $pro->category->name }}
                            </td>
                            <td class="px-6 py-4">
                                <form method="post" action="{{ route('products.destroy', $pro->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn edit icon-only" href="{{ route('products.edit', $pro->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <a class="btn edit icon-only" href="{{ route('subproducts.index', $pro->id) }}"><i
                                            class="fa-solid fa-list"></i></a>
                                    <button class="btn delete icon-only"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center">No product found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>