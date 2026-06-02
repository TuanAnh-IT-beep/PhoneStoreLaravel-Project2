<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
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
        $query = User::select('users.*')
            ->leftJoin('model_has_roles', function ($join) {
                $join->on('users.id', '=', 'model_has_roles.model_id')->where('model_has_roles.model_type', User::class);
            })
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where(function ($q) {
                $q->where('users.full_name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.email', 'like', '%' . $this->search . '%')
                    ->orWhere('users.phone', 'like', '%' . $this->search . '%');
            });
        if ($this->sortBy === 'role') {
            $query->orderBy('roles.name', $this->sortDir);
        } else {
            $query->orderBy('users.' . $this->sortBy, $this->sortDir);
        }

        return [
            'users' => $query->with('roles')->paginate(10),
        ];
    }
};
?>

<div>
    <div class="mb-4">
        <input type="text" wire:model.live="search" placeholder="Search users..."
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
                    <th scope="col" class="px-6 py-3 font-medium">Icon</th>
                    <th scope="col" class="px-6 py-3 font-medium whitespace-nowrap cursor-pointer"
                        wire:click="setSortBy('full_name')">Full Name @if ($sortBy === 'full_name')
                            <i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium whitespace-nowrap cursor-pointer"
                        wire:click="setSortBy('email')">Email @if ($sortBy === 'email')
                            <i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium whitespace-nowrap cursor-pointer"
                        wire:click="setSortBy('phone')">Phone @if ($sortBy === 'phone')
                            <i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium whitespace-nowrap cursor-pointer"
                        wire:click="setSortBy('role')">Role @if ($sortBy === 'role')
                            <i class="fa-solid fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($users) > 0)
                    @foreach ($users as $user)
                        <tr class="border-default">
                            <th class="px-6 py-4">
                                {{ $users->firstItem() + $loop->index }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($user->icon)
                                    <img src="{{ asset('storage/' . $user->icon) }}" alt="{{ $user->username }}"
                                        class="w-12 h-12 object-cover border rounded-full">
                                @else
                                    <span class="text-gray-400 text-sm">No image</span>
                                @endif
                            </td>
                            <td class="px-6 py-4" style="color: black">{{ $user->full_name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">{{ $user->phone }}</td>
                            <td class="px-6 py-4">{{ $user->roles->first()->name }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route(name: 'users.edit', parameters: $user->id) }}"
                                    class="btn icon-only edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                @if (auth('admin')->user()->id !== $user->id &&
                                        auth('admin')->user()->roles->first()->level > $user->roles->first()->level)
                                    <form method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this item?\nThis action cannot be undone.');"
                                        action="{{ route(name: 'users.destroy', parameters: $user->id) }}"
                                        style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn icon-only delete"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center">No user found.</td>
                    </tr>
                @endif
            </tbody>
            <tfoot>
                <tr style="border: 0;">
                    <td colspan="5" class="pt-4">
                        {{ $users->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
