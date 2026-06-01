<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

new class extends Component {
    use WithPagination;

    public string $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function with(): array
    {
        return [
            'categories' => Category::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->orderBy('id', 'asc')
                ->paginate(10),
        ];
    }
};
?>


<div>
    <div class="mb-4">
        <input type="text" wire:model.live="search" placeholder="Search categories..."
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div class="main-container">
        <table class="table-auto w-full text-left rtl:text-right text-body">
            <thead class="border-default">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">ID</th>
                    <th scope="col" class="px-6 py-3 font-medium">Icon</th>
                    <th scope="col" class="px-6 py-3 font-medium">Name</th>
                    <th scope="col" class="px-6 py-3 font-medium long">Description</th>
                    <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($categories) > 0)
                    @foreach ($categories as $category)
                        <tr scope="row" wire:key="category-{{ $category->id }}"
                            class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            <th class="px-6 py-4">{{ $category->id }}</th>
                            <td class="px-6 py-4">
                                @if ($category->icon)
                                    <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}">
                                @else
                                    <span class="text-gray-400 text-sm">No image</span>
                                @endif
                            </td>
                            <td class="px-6 py-4" style="color: black"> {{ $category->name }} </td>
                            <td class="px-6 py-4">{{ $category->description }}</td>
                            <td class="px-6 py-4">
                                <form method="post" action="{{ route('categories.destroy', $category->id) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn edit icon-only"
                                        href="{{ route('categories.edit', $category->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <button class="btn delete icon-only"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center">No category found.</td>
                    </tr>
                @endif
            </tbody>
            <tfoot>
                <tr style="border: 0;">
                    <td colspan="5" class="pt-4"> {{ $categories->links() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
