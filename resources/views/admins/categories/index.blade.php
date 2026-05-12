@extends("admins.layouts.master")
@section('pageTitle', 'Categories')
@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Categories</h1>
        <a class="btn" href="{{ route(name: 'categories.create') }}"><i class="fa-solid fa-plus"></i> ADD NEW ITEM</a>
    </div>
    <livewire:admins.category-list />
@endsection