@extends("admins.layouts.master")
@section('pageTitle', 'Manufacturers')
@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Manufacturers</h1>
        <a class="btn" href="{{ route(name: 'manufacturers.create') }}"><i class="fa-solid fa-plus"></i> ADD NEW ITEM</a>
    </div>
    <livewire:admins.manufacturer-list/>
@endsection