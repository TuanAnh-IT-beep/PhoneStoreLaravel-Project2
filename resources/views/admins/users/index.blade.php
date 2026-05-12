@extends("admins.layouts.master")
@section('pageTitle', 'Users')
@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Users</h1>
        <a class="btn" href="{{ route(name: 'users.create') }}"><i class="fa-solid fa-plus"></i> ADD NEW USER</a>
    </div>
    <livewire:admins.user-list/>

@endsection
