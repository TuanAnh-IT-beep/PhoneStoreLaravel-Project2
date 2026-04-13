@extends("admins.layouts.master")
@section('pageTitle', 'Customers')
@section("main-content")
    <div class="d-flex w-full mb-4 items-center justify-between">
        <h1>Customers</h1>
        <a class="btn" href="{{ route(name: 'customers.create') }}"><i class="fa-solid fa-plus"></i> ADD NEW CUSTOMER</a>
    </div>
    <div class="main-container">
        <table class="table-auto w-full text-left rtl:text-right text-body">
            <thead class="border-default">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">ID</th>
                    <th scope="col" class="px-6 py-3 font-medium long">Name</th>
                    <th scope="col" class="px-6 py-3 font-medium">Gender</th>
                    <th scope="col" class="px-6 py-3 font-medium">Email</th>
                    <th scope="col" class="px-6 py-3 font-medium">Phone</th>
                    <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($customers) > 0)
                    @foreach ($customers as $customer)
                        <tr scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            <th class="px-6 py-4">
                                {{ $customer->id }}
                            </th>
                            <td class="px-6 py-4" style="color: black"> {{ $customer->display_name }}</td>
                            <td class="px-6 py-4" style="color: black"> {{ $customer->gender }}</td>
                            <td class="px-6 py-4" style="color: black"> {{ $customer->email }}</td>
                            <td class="px-6 py-4" style="color: black"> {{ $customer->phone }}</td>
                            <td class="px-6 py-4">
                                <form method="post" action="{{ route('customers.destroy', $customer->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn edit icon-only" href="{{ route('customers.edit', $customer->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <button class="btn delete icon-only"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center">No customer found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection