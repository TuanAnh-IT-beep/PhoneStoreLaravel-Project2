@extends("layouts.master")

@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Users</h1>
        <a class="btn" href="{{ route(name: 'users.create') }}"><i class="fa-solid fa-plus"></i> ADD NEW ITEM</a>
    </div>
    <div class="main-container">
        <table class="table-auto w-full text-left rtl:text-right text-body">
            <thead class="border-default">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">ID</th>
                    <th scope="col" class="px-6 py-3 font-medium">Full Name</th>
                    <th scope="col" class="px-6 py-3 font-medium">Role</th>
                    <th scope="col" class="px-6 py-3 font-medium">Email</th>
                    <th scope="col" class="px-6 py-3 font-medium">Phone</th>
                    <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-default">
                        <td class="px-6 py-4">{{ $user->id }}</td>
                        <td class="px-6 py-4">{{ $user->full_name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">{{ $user->phone }}</td>
                        <td class="px-6 py-4">{{ $user->role }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route(name: 'users.edit', parameters: $user->id) }}" class="btn icon-only"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <form method="post" action="{{ route(name: 'users.destroy', parameters: $user->id) }}"
                                style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn icon-only negative"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

@endsection