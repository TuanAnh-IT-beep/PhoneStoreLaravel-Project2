@extends('admins.layouts.master')
@section('pageTitle', 'Payment Methods')
@section('main-content')
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Settings → Payment Methods</h1>
        <a class="btn" href="{{ route(name: 'payment_methods.create') }}"><i class="fa-solid fa-plus"></i> ADD NEW
            METHOD</a>
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
                @if (count(value: $payment_methods) > 0)
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
