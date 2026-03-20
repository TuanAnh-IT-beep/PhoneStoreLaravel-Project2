@extends("layouts.master")
@section("main-content")
    <h3>Manufacturer List</h3>
    <a href="{{ route(name: 'manufacturers.create') }}">Add a manufacturer</a>
    <table border="1px" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th></th>
        </tr>
        @foreach ($manufacturers as $manufacturer)
            <tr>
                <td>
                    {{ $manufacturer->id }}
                </td>
                <td>
                    {{ $manufacturer->name }}
                </td>
                <td>
                    {{ $manufacturer->description }}
                </td>
                <td>
                    <a href="{{ route('manufacturers.edit', $manufacturer->id) }}">Edit</a>
                    <form method="post" action="{{ route('manufacturers.delete', $manufacturer->id) }}">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
