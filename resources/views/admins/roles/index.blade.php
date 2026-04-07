@extends("admins.layouts.master")
@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Settings → Roles</h1>
        <a class="btn" href="{{ route(name: 'roles.create') }}"><i class="fa-solid fa-plus"></i> ADD NEW ROLE</a>
    </div>
    <div class="main-container">
        <table class="table-auto w-full text-left rtl:text-right text-body">
            <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">ID</th>
                    <th scope="col" class="px-6 py-3 font-medium long">Name</th>
                    <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count(value: $roles) > 0)
                    @foreach ($roles as $role)
                        <tr scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            <th class="px-6 py-4">
                                {{ $role->id }}
                            </th>
                            <td class="px-6 py-4" style="color: black"> {{ $role->name }}</td>
                            <td class="px-6 py-4">
                                <form method="post" action="{{ route('roles.destroy', $role->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn edit icon-only" href="{{ route('roles.edit', $role->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <button class="btn delete icon-only"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center">No role found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection