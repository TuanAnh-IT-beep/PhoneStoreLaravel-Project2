@extends('admins.layouts.master')
@section('pageTitle', 'Products')

@section('main-content')
    <div class="w-full flex mb-4 justify-between">
        <h1>Products</h1>
        <a class="btn" href="{{ route(name: 'products.create') }}"><i class="fa-solid fa-plus"></i>ADD NEW ITEM</a>
    </div>
    @if (session('success'))
        <div class="p-4 text-sm text-emerald-500 rounded-xl bg-emerald-50 border border-emerald-400 font-normal mb-4"
            role="alert"> <span class="font-semibold mr-2">Success</span> {{ session('success') }}
        </div>
    @endif
    <livewire:admins.product-list />
@endsection
