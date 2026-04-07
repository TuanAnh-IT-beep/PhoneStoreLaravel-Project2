@extends("admins.layouts.master")
@section('pageTitle', 'Categories')
@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Categories</h1>
        <a class="btn" href="{{ route(name: 'categories.create') }}"><i class="fa-solid fa-plus"></i> ADD NEW ITEM</a>
    </div>
    <div class="main-container">
        <table class="table-auto w-full text-left rtl:text-right text-body">
            <thead class="border-default">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">ID</th>
                    <th scope="col" class="px-6 py-3 font-medium">Name</th>
                    <th scope="col" class="px-6 py-3 font-medium long">Description</th>
                    <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($categories)>0)
                    @foreach ($categories as $category)
                        <tr scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            <th class="px-6 py-4">
                                {{ $category->id }}
                            </th>
                            <td class="px-6 py-4" style="color: black"> {{ $category->name }} </td>
                            <td class="px-6 py-4">
                                {{ $category->description }}
                            </td>
                            <td class="px-6 py-4">
                                <form method="post" action="{{ route('categories.destroy', $category->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn edit icon-only" href="{{ route('categories.edit', $category->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <button class="btn delete icon-only"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center">No category found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

@endsection
