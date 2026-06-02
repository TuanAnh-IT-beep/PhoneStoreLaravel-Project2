@extends('clients.layouts.master')
@section('title', 'Cart')
@section('main-content')
    <div class="main-content">
        @livewire('client.cart-component')
    </div>
@endsection
