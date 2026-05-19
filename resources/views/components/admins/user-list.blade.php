<?php

use Livewire\Component;
use App\Models\User;
new class extends Component {
    public string $search = '';

    public function with(): array
    {
        return [
            'users' => User::where('full_name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('phone', 'like', '%' . $this->search . '%')
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
                    <th scope="col" class="px-6 py-3 font-medium">Icon</th>
                    <th scope="col" class="px-6 py-3 font-medium">Full Name</th>
                    <th scope="col" class="px-6 py-3 font-medium">Email</th>
                    <th scope="col" class="px-6 py-3 font-medium">Phone</th>
                    <th scope="col" class="px-6 py-3 font-medium">Role</th>
                    <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($users) > 0)

                    @foreach ($users as $user)
                        <tr class="border-default">
                            <th class="px-6 py-4">{{ $user->id }}</td>
                            <td class="px-6 py-4">
                                @if($user->icon)
                                    <img src="{{ asset('storage/' . $user->icon) }}" alt="{{ $user->username }}"
                                        class="w-12 h-12 object-cover border rounded-full">
                                @else
                                    <span class="text-gray-400 text-sm">No image</span>
                                @endif
                            </td>
                            <td class="px-6 py-4" style="color: black">{{ $user->full_name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">{{ $user->phone }}</td>
                            <td class="px-6 py-4">{{ $user->role->name }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route(name: 'users.edit', parameters: $user->id) }}" class="btn icon-only edit"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <form method="post" action="{{ route(name: 'users.destroy', parameters: $user->id) }}"
                                    style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn icon-only delete"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center">No user found.</td>
                    </tr>
                @endif
            </tbody>

        </table>
    </div>
</div>