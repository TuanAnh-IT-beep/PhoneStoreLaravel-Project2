<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Spec;

new class extends Component {
    use WithPagination;

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
        return [
            'specs' => Spec::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('suffix', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate(5),
        ];
    }
};
?>

<div>
    <div class="mb-4">
        <input type="text" wire:model.live="search" placeholder="Search specs..."
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
    <div class="main-container my-4">
        <table class="table-auto w-full text-left rtl:text-right text-body">
            <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium whitespace-nowrap cursor-pointer"
                        wire:click="setSortBy('id')"># @if ($sortBy === 'id')
                            <i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium whitespace-nowrap cursor-pointer long"
                        wire:click="setSortBy('name')">Name @if ($sortBy === 'name')
                            <i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium whitespace-nowrap cursor-pointer"
                        wire:click="setSortBy('suffix')">Suffix @if ($sortBy === 'name')
                            <i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count(value: $specs) > 0)
                    @foreach ($specs as $spec)
                        <tr scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            <th class="px-6 py-4">
                                {{ $spec->id }}
                            </th>
                            <td class="px-6 py-4" style="color: black"> {{ $spec->name }}</td>
                            <td class="px-6 py-4" style="color: black"> {{ $spec->suffix }}</td>
                            <td class="px-6 py-4">
                                <form method="post" action="{{ route('specs.destroy', $spec->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn edit icon-only" href="{{ route('specs.edit', $spec->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <button class="btn delete icon-only"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center">No spec found.</td>
                    </tr>
                @endif
            </tbody>
            <tfoot>
                <tr style="border: 0;">
                    <td colspan="4" class="pt-4"> {{ $specs->links(data: ['scrollTo' => false]) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
