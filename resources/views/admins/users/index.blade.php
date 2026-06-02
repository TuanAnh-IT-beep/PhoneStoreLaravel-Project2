@extends('admins.layouts.master')
@section('pageTitle', 'Users')
@section('main-content')
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Users</h1>
        <a class="btn" href="{{ route(name: 'users.create') }}"><i class="fa-solid fa-plus"></i> ADD NEW USER</a>
    </div>
    @if (session('error'))
        <div class="p-4 text-sm text-red-500 rounded-xl bg-red-50 border border-red-400 font-normal mb-4" role="alert">
            <span class="font-semibold mr-2">Error</span>{{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="p-4 text-sm text-emerald-500 rounded-xl bg-emerald-50 border border-emerald-400 font-normal mb-4"
            role="alert"> <span class="font-semibold mr-2">Success</span> {{ session('success') }}
        </div>
    @endif
    <livewire:admins.user-list />

@endsection
