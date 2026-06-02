@extends('admins.layouts.master')
@section('pageTitle', 'Users - Edit {{ $user->username }}]')

@section('main-content')
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Users → {{ $user->username }} → Edit</h1>
    </div>
    @if (session('error'))
        <div class="p-4 text-sm text-red-500 rounded-xl bg-red-50 border border-red-400 font-normal mb-4" role="alert">
            <span class="font-semibold mr-2">Error</span>{{ session('error') }}
        </div>
    @endif
    <div class="main-container">
        <form method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-5">
                    <label for="name">Username:</label><br>
                    <input required class="my-3 w-full" type="text" name="username" placeholder="Input username here..."
                        value="{{ $user->username }}"><br>
                    <label for="email">Email:</label><br>
                    <input required class="my-3 w-full" type="email" name="email" placeholder="Input email here..."
                        value="{{ $user->email }}"><br>
                    <label for="full_name">Full name:</label><br>
                    <input required class="my-3 w-full" type="text" name="full_name"
                        placeholder="Input full name here..." value="{{ $user->full_name }}"><br>
                    <label for="phone">Phone:</label><br>
                    <input required class="my-3 w-full" type="tel" name="phone"
                        placeholder="Input phone number here..." value="{{ $user->phone }}"><br>
                    @if (auth('admin')->user()->roles->first()->level > $user->roles->first()->level)
                        <label for="role_id">Role:</label><br>
                        <select required class="my-3 w-full" name="role_id">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ auth('admin')->user()->roles->first()->level > $role->level ? '' : 'disabled' }}
                                    {{ $user->roles->contains('id', $role->id) ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                    <div class="flex gap-2 mt-4">
                        <button class="btn icon-only flex-1">UPDATE</button>
                        <a class="btn icon-only negative flex-1" href="{{ route('users.index') }}">CANCEL</a>
                    </div>
                </div>
                <div class="col-span-5">
                    <label for="icon">Icon:</label><br>
                    <input class="my-3" type="file" name="icon" accept="image/*" onchange="previewIcon(event)"><br>
                    <img id="icon_preview" src="{{ $user->icon ? asset('storage/' . $user->icon) : '#' }}"
                        alt="Icon Preview"
                        class="w-64 h-64 object-cover border rounded mb-3 {{ $user->icon ? '' : 'hidden' }}"><br>

                    <script>
                        function previewIcon(event) {
                            const output = document.getElementById('icon_preview');
                            if (event.target.files && event.target.files[0]) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    output.src = e.target.result;
                                    output.classList.remove('hidden');
                                };
                                reader.readAsDataURL(event.target.files[0]);
                            }
                        }
                    </script>
                </div>
            </div>
        </form>
    </div>
@endsection
