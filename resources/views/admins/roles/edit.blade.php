@extends('admins.layouts.master')
@section('pageTitle', 'Roles → Edit')
@section('main-content')
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Settings → Roles → {{ $role->name }} → Edit</h1>
    </div>
    @if (session('error'))
        <div class="p-4 text-sm text-red-500 rounded-xl bg-red-50 border border-red-400 font-normal mb-4" role="alert">
            <span class="font-semibold mr-2">Error</span>{{ session('error') }}
        </div>
    @endif
    <div class="main-container">
        <form method="post" action="{{ route('roles.update', $role->id) }}">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <label for="name">Name:</label><br>
                    <input required class="my-2 w-full" type="text" name="name" value="{{ $role->name }}"
                        placeholder="Input name here..."><br>
                    <label for="level">Level:</label><br>
                    <input required class="my-2 w-full" type="number" name="level" placeholder="Input level here..."
                        max="{{ auth('admin')->user()->roles->first()->level }}" value="{{ $role->level }}"><br>
                    <div class="flex gap-2 mt-4">
                        <button class="btn flex-1 icon-only">UPDATE</button>
                        <a class="btn flex-1 icon-only negative" href="{{ route('admins.settings.index') }}">CANCEL</a>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="permissions">Permissions:</label>
                    <div class="my-2 grid grid-cols-3 gap-2">
                        @foreach ($permissions as $permission)
                            <div>
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                    id="perm_{{ $permission->id }}"
                                    {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                <label for="perm_{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
