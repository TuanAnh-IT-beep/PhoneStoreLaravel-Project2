<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Permission;

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
            'permissions' => Permission::where('name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate(5),
        ];
    }
};
?>

<div>
    <div class="mb-4">
        <input type="text" wire:model.live="search" placeholder="Search permissions..."
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
    <div class="main-container my-4">
        <table class="table-auto w-full text-left rtl:text-right text-body">
            <thead class="border-default">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium whitespace-nowrap cursor-pointer"
                        wire:click="setSortBy('id')"># @if ($sortBy === 'id')
                            <i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium long whitespace-nowrap cursor-pointer"
                        wire:click="setSortBy('name')">Name @if ($sortBy === 'name')
                            <i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($permissions) > 0)
                    @foreach ($permissions as $permission)
                        <tr scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            <th class="px-6 py-4">
                                {{ $permissions->firstItem() + $loop->index }}
                            </th>
                            <td class="px-6 py-4" style="color: black"> {{ $permission->name }}</td>
                            <td class="px-6 py-4">
                                <form method="post"
                                    onsubmit="return confirm('Are you sure you want to delete this item?\nThis action cannot be undone.');"
                                    action="{{ route('permissions.destroy', $permission->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn edit icon-only"
                                        href="{{ route('permissions.edit', $permission->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <button class="btn delete icon-only"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center">No permission found.</td>
                    </tr>
                @endif
            </tbody>
            <tfoot>
                <tr style="border: 0;">
                    <td colspan="3" class="pt-4"> {{ $permissions->links(data: ['scrollTo' => false]) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
