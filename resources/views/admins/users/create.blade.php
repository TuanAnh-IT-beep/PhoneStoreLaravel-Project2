@extends("admins.layouts.master")
@section('pageTitle', 'Users - Add')

@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Users → New</h1>
    </div>
    <div class="main-container">
        <form method="post" action="{{ route('users.store') }}">
            @csrf
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <label for="name">Username:</label><br>
                    <input class="my-3 w-full" type="text" name="username" placeholder="Input username here..."><br>
                    <label for="email">Email:</label><br>
                    <input class="my-3 w-full" type="email" name="email" placeholder="Input email here..."><br>
                    <label for="password">Password:</label><br>
                    <input class="my-3 w-full" type="password" name="password" placeholder="Input password here..."><br>
                    <label for="full_name">Full name:</label><br>
                    <input class="my-3 w-full" type="text" name="full_name" placeholder="Input full name here..."><br>
                    <label for="phone">Phone:</label><br>
                    <input class="my-3 w-full" type="tel" name="phone" placeholder="Input phone number here..."><br>
                    <label for="role_id">Role:</label><br>
                    <select class="my-3 w-full" name="role_id">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <div class="flex gap-2 mt-4">
                        <button class="btn icon-only flex-1">ADD</button>
                        <a class="btn icon-only negative flex-1" href="{{ route('users.index') }}">CANCEL</a>
                    </div>
                </div>
                <div class="col-span-6">
                </div>
            </div>
        </form>
    </div>
@endsection
