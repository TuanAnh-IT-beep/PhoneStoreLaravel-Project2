@extends("admins.layouts.master")
@section('pageTitle', 'Specs')
@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Settings → Specs</h1>
        <a class="btn" href="{{ route(name: 'specs.create') }}"><i class="fa-solid fa-plus"></i> ADD NEW SPEC</a>
    </div>
    <div class="main-container">
        <table class="table-auto w-full text-left rtl:text-right text-body">
            <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">ID</th>
                    <th scope="col" class="px-6 py-3 font-medium long">Name</th>
                    <th scope="col" class="px-6 py-3 font-medium">Suffix</th>
                    <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count(value: $specs) > 0)
                    @foreach ($specs as $spec)
                        <tr scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            <th class="px-6 py-4">
                                {{ $spec->id }}
                            </th>
                            <td class="px-6 py-4" style="color: black"> {{ $spec->name }}</td>
                            <td class="px-6 py-4" style="color: black"> {{ $spec->suffix }}</td>
                            <td class="px-6 py-4">
                                <form method="post" action="{{ route('specs.destroy', $spec->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn edit icon-only" href="{{ route('specs.edit', $spec->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <button class="btn delete icon-only"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center">No spec found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
