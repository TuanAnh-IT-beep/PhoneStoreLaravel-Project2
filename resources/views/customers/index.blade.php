@extends("layouts.master")

@section("main-content")
<h3>Customer List</h3>
<a href="{{ route(name: 'customers.create') }}">Add a customer</a>
<table border="1px" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th></th>
    </tr>
    @foreach ($customers as $customer)
        <tr>
            <td>
                {{ $customer->id }}
            </td>
            <td>
                {{ $customer->display_name }}
            </td>
            <td>
                {{ $customer->gender }}
            </td>
            <td>
                {{ $customer->email }}
            </td>
            <td>
                {{ $customer->phone }}
            </td>
            <td>
                <a href="{{ route('customers.edit', $customer->id) }}">Edit</a>
                <form method="post" action="{{ route('customers.delete', $customer->id) }}">
                    @csrf
                    @method('DELETE')
                    <button>Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
@endsection