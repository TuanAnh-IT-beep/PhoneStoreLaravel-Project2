@extends("admins.layouts.master")
@section('pageTitle', 'Subproducts - {{ $product->name }}')
@section("main-content")
    <div class="w-full flex mb-4 justify-between">
        <h1 class="">Products -> {{ $product->name }} -> Subproducts</h1>
        <a class="btn" href="{{ route('subproducts.create', $product) }}"><i class="fa-solid fa-plus"></i>ADD NEW ITEM</a>
    </div>
    @livewire("admins.subproduct-list", ['product' => $product])
@endsection