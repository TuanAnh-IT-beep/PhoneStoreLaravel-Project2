@extends("admins.layouts.master")
@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Settings</h1>
    </div>
    <div class="w-full my-4 flex items-center justify-between">
        <h3>Permissions</h3>
        <a class="btn" href="{{ route(name: 'permissions.create') }}"><i class="fa-solid fa-plus"></i> ADD NEW
            PERMISSION</a>
    </div>
    <div class="main-container my-4">
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
    <div class="w-full my-4 flex items-center justify-between">
        <h3>Roles</h3>
        <a class="btn" href="{{ route(name: 'roles.create') }}"><i class="fa-solid fa-plus"></i> ADD NEW ROLE</a>
    </div>
    <div class="main-container my-4">
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
    <div class="w-full my-4 flex items-center justify-between">
        <h3>Payment Methods</h3>
        <a class="btn" href="{{ route(name: 'payment_methods.create') }}"><i class="fa-solid fa-plus"></i> ADD NEW
            METHOD</a>
    </div>
    <div class="main-container my-4">
        <table class="table-auto w-full text-left rtl:text-right text-body">
            <thead class="border-default">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">ID</th>
                    <th scope="col" class="px-6 py-3 font-medium long">Name</th>
                    <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count(value: $payment_methods) > 0)
                    @foreach ($payment_methods as $method)
                        <tr scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            <th class="px-6 py-4">
                                {{ $method->id }}
                            </th>
                            <td class="px-6 py-4" style="color: black"> {{ $method->name }}</td>
                            <td class="px-6 py-4">
                                <form method="post" action="{{ route('payment_methods.destroy', $method->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn edit icon-only" href="{{ route('payment_methods.edit', $method->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <button class="btn delete icon-only"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center">No method found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection