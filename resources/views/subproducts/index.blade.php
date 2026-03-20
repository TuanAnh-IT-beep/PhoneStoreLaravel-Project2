@extends("layouts.master")

@section("main-content")
    <div class="w-full flex mb-4 justify-between">
        <h1 class="">Products</h1>
        <a class="btn" href="{{ route(name: 'subproducts.create') }}"><i class="fa-solid fa-plus"></i>ADD NEW ITEM</a>
    </div>
    @if (count($subproducts)) > 0
        <table border="1px" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Price</th>
                <th>Stock</th>
                <th></th>
            </tr>
            @foreach ($subproducts as $pro)
                <tr>
                    <td>
                        {{ $pro->id }}
                    </td>
                    <td>
                        {{ $pro->name }}
                    </td>
                    <td>
                        {{ $pro->thumbnail_path }}
                    </td>
                    <td>
                        {{ $pro->price }}
                    </td>
                    <td>
                        {{ $pro->stock }}
                    </td>
                    <td>
                        <a href="{{ route('subproducts.edit', $pro->id) }}">Edit</a>
                        <form method="post" action="{{ route('subproducts.delete', $pro->id) }}">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No product</p>
    @endif
@endsection
