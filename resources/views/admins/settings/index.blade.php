@extends('admins.layouts.master')
@section('pageTitle', 'Settings')

@section('main-content')
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Settings</h1>
    </div>
    @if (session('success'))
        <div class="p-4 text-sm text-emerald-500 rounded-xl bg-emerald-50 border border-emerald-400 font-normal mb-4"
            role="alert"> <span class="font-semibold mr-2">Success</span> {{ session('success') }}
        </div>
    @endif
    <div class="w-full my-4 flex items-center justify-between">
        <h3>Permissions</h3>
        <a class="btn" href="{{ route(name: 'permissions.create') }}"><i class="fa-solid fa-plus"></i> ADD NEW
            PERMISSION</a>
    </div>
    @livewire('admins.permission-list')
    <div class="w-full my-4 flex items-center justify-between">
        <h3>Roles</h3>
        <a class="btn" href="{{ route(name: 'roles.create') }}"><i class="fa-solid fa-plus"></i> ADD NEW ROLE</a>
    </div>
    @livewire('admins.role-list')
    <div class="w-full my-4 flex items-center justify-between">
        <h3>Payment Methods</h3>
        <a class="btn" href="{{ route(name: 'payment_methods.create') }}"><i class="fa-solid fa-plus"></i> ADD NEW
            METHOD</a>
    </div>
    @livewire('admins.payment-method-list')
    <div class="w-full my-4 flex items-center justify-between">
        <h3>Specs</h3>
        <a class="btn" href="{{ route(name: 'specs.create') }}"><i class="fa-solid fa-plus"></i> ADD NEW
            SPEC</a>
    </div>
    @livewire('admins.spec-list')
@endsection
