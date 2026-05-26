@extends('admins.layouts.master')
@section('pageTitle', 'Orders - New')
@section('main-content')
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Orders → New</h1>
    </div>
    @livewire('admins.orders-create', ['payment_methods' => $payment_methods])
@endsection
