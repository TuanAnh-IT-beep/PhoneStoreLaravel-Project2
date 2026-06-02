@extends('admins.layouts.master')
@section('pageTitle', 'Roles → New')
@section('main-content')
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Settings → Roles → New</h1>
    </div>
    @if (session('error'))
        <div class="p-4 text-sm text-red-500 rounded-xl bg-red-50 border border-red-400 font-normal mb-4" role="alert">
            <span class="font-semibold mr-2">Error</span>{{ session('error') }}
        </div>
    @endif
    <div class="main-container">
        <form method="post" action="{{ route('roles.store') }}">
            @csrf
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <label for="name">Name:</label><br>
                    <input required class="mt-2 w-full" type="text" name="name" placeholder="Input name here..."><br>
                    <label for="level">Level:</label><br>
                    <input required class="mt-2 w-full" type="number" name="level" placeholder="Input level here..." max="{{ auth('admin')->user()->roles->first()->level }}"><br>
                    <div class="flex gap-2 mt-4">
                        <button class="btn flex-1 icon-only">ADD</button>
                        <a class="btn flex-1 icon-only negative" href="{{ route('admins.settings.index') }}">CANCEL</a>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="permissions">Permissions:</label>
                    <div class="mt-2 grid grid-cols-3 gap-2">
                        @foreach ($permissions as $permission)
                            @if (auth('admin')->user()->hasPermissionTo($permission->name, 'admin'))
                                <div>
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                        id="perm_{{ $permission->id }}">
                                    <label for="perm_{{ $permission->id }}">{{ $permission->name }}</label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
