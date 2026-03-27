@extends("layouts.master")

@section("main-content")
    <div class="w-full flex mb-4 justify-between">
        <h1 class="">Products</h1>
        <a class="btn" href="{{ route(name: 'products.create') }}"><i class="fa-solid fa-plus"></i>ADD NEW ITEM</a>
    </div>
    <div class="main-container">
        <table class="table-auto w-full text-left rtl:text-right text-body">
            <thead class="border-default">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">ID</th>
                    <th scope="col" class="px-6 py-3 font-medium">Name</th>
                    <th scope="col" class="px-6 py-3 font-medium">Price</th>
                    <th scope="col" class="px-6 py-3 font-medium">Stock</th>
                    <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($products) > 0)
                    @foreach ($products as $pro)
                        <tr scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            <th class="px-6 py-4"> 
                                {{ $pro->id }}
                            </th>
                            <td class="px-6 py-4" style="color: black">
                                {{ $pro->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pro->price }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pro->stock }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('products.edit', $pro->id) }}">Edit</a>
                                <form method="post" action="{{ route('products.destroy', $pro->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button>Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center">No product found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection