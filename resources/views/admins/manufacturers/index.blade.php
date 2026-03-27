@extends("admins.layouts.master")
@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Manufacturers</h1>
        <a class="btn" href="{{ route(name: 'manufacturers.create') }}"><i class="fa-solid fa-plus"></i> ADD NEW ITEM</a>
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
                @if (count($manufacturers) > 0)
                    @foreach ($manufacturers as $manufacturer)
                        <tr scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            <th class="px-6 py-4">
                                {{ $manufacturer->id }}
                            </th>
                            <td class="px-6 py-4" style="color: black"> {{ $manufacturer->name }} </td>
                            <td class="px-6 py-4">
                                {{ $manufacturer->description }}
                            </td>
                            <td class="px-6 py-4">
                                <form method="post" action="{{ route('manufacturers.destroy', $manufacturer->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn edit icon-only" href="{{ route('manufacturers.edit', $manufacturer->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <button class="btn delete icon-only"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center">No manufacturer found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
