@extends('admins.layouts.master')
@section('pageTitle', 'Roles - Edit {{ $role->name }}')
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
                    <input required class="mt-2 w-full" type="text" name="name" value="{{ $role->name }}"
                        placeholder="Input name here..."><br>

                    <label class="mt-4 block" for="permissions">Permissions:</label>
                    <div class="mt-2 grid grid-cols-2 gap-2">
                        @foreach ($permissions as $permission)
                            <div>
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                    id="perm_{{ $permission->id }}"
                                    {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                <label for="perm_{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex gap-2 mt-4">
                        <button class="btn flex-1 icon-only">UPDATE</button>
                        <a class="btn flex-1 icon-only negative" href="{{ route('admins.settings.index') }}">CANCEL</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
