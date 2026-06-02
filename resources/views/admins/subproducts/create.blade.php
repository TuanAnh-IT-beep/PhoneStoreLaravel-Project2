@extends('admins.layouts.master')
@section('pageTitle', 'Subproducts → New')
@section('main-content')
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Products → {{ $product->name }} → Subproducts → New</h1>
    </div>
    @if (session('error'))
        <div class="p-4 text-sm text-red-500 rounded-xl bg-red-50 border border-red-400 font-normal mb-4" role="alert">
            <span class="font-semibold mr-2">Error</span>{{ session('error') }}
        </div>
    @endif

    @livewire('admins.subproduct-create-form', ['product' => $product, 'allSpecs' => $specs])
@endsection
