@extends("admins.layouts.master")
@section('pageTitle', 'Customers')
@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Customers</h1>
        <a class="btn" href="{{ route(name: 'customers.create') }}"><i class="fa-solid fa-plus"></i> ADD NEW CUSTOMER</a>
    </div>
    <livewire:admins.customer-list/>
@endsection