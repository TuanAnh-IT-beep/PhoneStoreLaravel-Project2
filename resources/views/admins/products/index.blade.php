@extends("admins.layouts.master")
@section('pageTitle', 'Products')

@section("main-content")
    <div class="w-full flex mb-4 justify-between">
        <h1>Products</h1>
        <a class="btn" href="{{ route(name: 'products.create') }}"><i class="fa-solid fa-plus"></i>ADD NEW ITEM</a>
    </div>
    <livewire:admins.product-list />
@endsection