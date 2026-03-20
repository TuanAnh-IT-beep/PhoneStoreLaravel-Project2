@extends("layouts.master")

@section("main-content")
    <div class="w-full flex mb-4 justify-between">
        <h1 class="">Categories</h1>
        <a class="btn" href="{{ route(name: 'categories.create') }}"><i class="fa-solid fa-plus"></i>ADD NEW ITEM</a>
    </div>
    @if (count($categories)) > 0
        <table border="1px" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th></th>
            </tr>
            @foreach ($categories as $category)
                <tr>
                    <td>
                        {{ $category->id }}
                    </td>
                    <td>
                        {{ $category->name }}
                    </td>
                    <td>
                        {{ $category->description }}
                    </td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}">Edit</a>
                        <form method="post" action="{{ route('categories.delete', $category->id) }}">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No category found.</p>
    @endif
@endsection