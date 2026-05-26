<?php

use Livewire\Component;
use App\Models\Manufacturer;

new class extends Component {
    public string $search = '';

    public function with(): array
    {
        return [
            'manufacturers' => Manufacturer::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->orderBy('id', 'asc')
                ->get(),
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
                    <th scope="col" class="px-6 py-3 font-medium">ID</th>
                    <th scope="col" class="px-6 py-3 font-medium">Icon</th>
                    <th scope="col" class="px-6 py-3 font-medium">Name</th>
                    <th scope="col" class="px-6 py-3 font-medium long">Description</th>
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
                                @if($manufacturer->icon)
                                    <img src="{{ asset('storage/' . $manufacturer->icon) }}" alt="{{ $manufacturer->name }}">
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
                                    <a class="btn edit icon-only" href="{{ route('manufacturers.edit', $manufacturer->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <button class="btn delete icon-only"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center">No manufacturer found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
