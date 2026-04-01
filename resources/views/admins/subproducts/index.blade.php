@extends("admins.layouts.master")

@section("main-content")
    <div class="w-full flex mb-4 justify-between">
        <h1 class="">Products -> {{ $product->name }} -> Subproducts</h1>
        <a class="btn" href="{{ route('subproducts.create', $product->id) }}"><i class="fa-solid fa-plus"></i>ADD NEW ITEM</a>
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
                @if (count($subproducts) > 0)
                    @foreach ($subproducts as $subproduct)
                        <tr scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            <th class="px-6 py-4">
                                {{ $subproduct->id }}
                            </th>
                            <td class="px-6 py-4" style="color: black">
                                {{ $subproduct->name }}
                            </td>
                            <td class="px-6 py-4" style="color: black">
                                {{ $subproduct->price }}
                            </td>
                            <td class="px-6 py-4" style="color: black">
                                {{ $subproduct->stock }}
                            </td>
                            <td class="px-6 py-4">
                                <form method="post" action="{{ route('subproducts.destroy', $subproduct->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn edit icon-only" href="{{ route('subproducts.edit', $subproduct->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <button class="btn delete icon-only"><i class="fa-solid fa-list"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center">No subproduct found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection