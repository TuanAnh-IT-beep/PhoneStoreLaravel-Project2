@extends("admins.layouts.master")
@section('pageTitle', 'Orders')

@section("main-content")
    <div class="w-full flex mb-4 justify-between">
        <h1>Orders</h1>
    </div>
    <livewire:admins.orders-list />
@endsection