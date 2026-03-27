@extends("admins.layouts.master")
@section("main-content")
<div class="w-full mb-4 flex items-center justify-between">
        <h1>Payment method List</h1>
        <a class="btn" href="{{ route(name: 'payment_methods.create') }}"><i class="fa-solid fa-plus"></i> ADD NEW METHOD</a>
    </div>
    <div class="main-container">
        <table class="table-auto w-full text-left rtl:text-right text-body">
            <thead class="border-default">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">ID</th>
                    <th scope="col" class="px-6 py-3 font-medium long">Name</th>
                    <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($payment_methods)>0)
                    @foreach ($payment_methods as $method)
                        <tr scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            <th class="px-6 py-4">
                                {{ $method->id }}
                            </th>
                            <td class="px-6 py-4" style="color: black"> {{ $method->name }}</td>
                            <td class="px-6 py-4">
                                <form method="post" action="{{ route('payment_methods.destroy', $method->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn edit icon-only" href="{{ route('payment_methods.edit', $method->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <button class="btn delete icon-only"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center">No method found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection

    {{-- <h3>Manufacturer List</h3>
    <a href="{{ route(name: 'payment-methods.create') }}">Add a payment_method</a>
    <table border="1px" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th></th>
        </tr>
        @foreach ($payment_methods as $payment_method)
            <tr>
                <td>
                    {{ $payment_method->id }}
                </td>
                <td>
                    {{ $payment_method->name }}
                </td>
                <td>
                    <a href="{{ route('payment_methods.edit', $payment_method->id) }}">Edit</a>
                    <form method="post" action="{{ route('payment_methods.delete', $payment_method->id) }}">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table> --}}
</body>

</html>
