@extends("admins.layouts.master")
@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Settings → Permissions</h1>
        <a class="btn" href="{{ route(name: 'permissions.create') }}"><i class="fa-solid fa-plus"></i> ADD NEW
            PERMISSION</a>
    </div>
    <div class="main-container">
        <table class="table-auto w-full text-left rtl:text-right text-body">
            <thead class="border-default">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">ID</th>
                    <th scope="col" class="px-6 py-3 font-medium long">Name</th>
                    <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count(value: $permissions) > 0)
                    @foreach ($permissions as $permission)
                        <tr scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            <th class="px-6 py-4">
                                {{ $permission->id }}
                            </th>
                            <td class="px-6 py-4" style="color: black"> {{ $permission->name }}</td>
                            <td class="px-6 py-4">
                                <form method="post" action="{{ route('permissions.destroy', $permission->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn edit icon-only" href="{{ route('permissions.edit', $permission->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <button class="btn delete icon-only"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center">No permission found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection