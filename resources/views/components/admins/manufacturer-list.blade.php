<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Manufacturer;

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
            'manufacturers' => Manufacturer::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate(1),
        ];
    }
};
?>

<div>
    <div class="mb-4">
        <input type="text" wire:model.live="search" placeholder="Search manufacturers..."
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
    <div class="main-container">
        <table class="table-auto w-full text-left rtl:text-right text-body">
            <thead class="border-default">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium whitespace-nowrap cursor-pointer" wire:click="setSortBy('id')">ID @if($sortBy === 'id')<i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>@endif</th>
                    <th scope="col" class="px-6 py-3 font-medium">Icon</th>
                    <th scope="col" class="px-6 py-3 font-medium whitespace-nowrap cursor-pointer" wire:click="setSortBy('name')">Name @if($sortBy === 'name')<i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>@endif</th>
                    <th scope="col" class="px-6 py-3 font-medium whitespace-nowrap long cursor-pointer" wire:click="setSortBy('description')">Description @if($sortBy === 'description')<i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>@endif</th>
                    <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($manufacturers) > 0)
                    @foreach ($manufacturers as $manufacturer)
                        <tr scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            <th class="px-6 py-4">
                                {{ $manufacturer->id }}
                            </th>
                            <td class="px-6 py-4">
                                @if ($manufacturer->icon)
                                    <img src="{{ asset('storage/' . $manufacturer->icon) }}"
                                        alt="{{ $manufacturer->name }}">
                                @else
                                    <span class="text-gray-400 text-sm">No image</span>
                                @endif
                            </td>
                            <td class="px-6 py-4" style="color: black"> {{ $manufacturer->name }} </td>
                            <td class="px-6 py-4">
                                {{ $manufacturer->description }}
                            </td>
                            <td class="px-6 py-4">
                                <form method="post" action="{{ route('manufacturers.destroy', $manufacturer->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn edit icon-only"
                                        href="{{ route('manufacturers.edit', $manufacturer->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <button class="btn delete icon-only"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center">No manufacturer found.</td>
                    </tr>
                @endif
            </tbody>
            <tfoot>
                <tr style="border: 0;">
                    <td colspan="5" class="pt-4"> {{ $manufacturers->links() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
