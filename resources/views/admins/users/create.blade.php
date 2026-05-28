@extends('admins.layouts.master')
@section('pageTitle', 'Users - Add')

@section('main-content')
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Users → New</h1>
    </div>
    @if (session('error'))
        <div class="p-4 text-sm text-red-500 rounded-xl bg-red-50 border border-red-400 font-normal mb-4" role="alert">
            <span class="font-semibold mr-2">Error</span>{{ session('error') }}
        </div>
    @endif
    <div class="main-container">
        <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-5">
                    <label for="name">Username:</label><br>
                    <input required class="my-3 w-full" type="text" name="username"
                        placeholder="Input username here..."><br>
                    <label for="email">Email:</label><br>
                    <input required class="my-3 w-full" type="email" name="email" placeholder="Input email here..."><br>
                    <label for="password">Password:</label><br>
                    <input required class="my-3 w-full" type="password" name="password"
                        placeholder="Input password here..."><br>
                    <label for="full_name">Full name:</label><br>
                    <input required class="my-3 w-full" type="text" name="full_name"
                        placeholder="Input full name here..."><br>
                    <label for="phone">Phone:</label><br>
                    <input required class="my-3 w-full" type="tel" name="phone"
                        placeholder="Input phone number here..."><br>
                    <label for="role_id">Role:</label><br>
                    <select required class="my-3 w-full" name="role_id">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <div class="flex gap-2 mt-4">
                        <button class="btn icon-only flex-1">ADD</button>
                        <a class="btn icon-only negative flex-1" href="{{ route('users.index') }}">CANCEL</a>
                    </div>
                </div>
                <div class="col-span-5">
                    <label for="icon">Icon:</label><br>
                    <input class="my-3" type="file" name="icon" accept="image/*" onchange="previewIcon(event)"><br>
                    <img id="icon_preview" class="w-32 h-32 object-cover border rounded mb-3 hidden" src="#"
                        alt="Icon Preview"><br>
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
