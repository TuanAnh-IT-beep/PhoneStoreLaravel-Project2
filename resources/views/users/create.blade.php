@extends("layouts.master")

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
                    <input class="mt-2 w-full" type="text" name="name" placeholder="Input username here..."><br>
                    <label for="email">Email:</label><br>
                    <input class="mt-2 w-full" type="email" name="email" placeholder="Input email here..."><br>
                    <label for="password_hash">Password:</label><br>
                    <input class="mt-2 w-full" type="password" name="password_hash" placeholder="Input password here..."><br>
                    <label for="role">Role:</label><br>
                    <select class="mt-2 w-full" name="role">
                        
                    <div class="flex gap-2 mt-4">
                        <button class="btn icon-only flex-1">CREATE</button>
                        <a class="btn icon-only negative flex-1" href="{{ route('users.index') }}">CANCEL</a>
                    </div>
                </div>
                <div class="col-span-6">
                </div>
            </div>
        </form>
    </div>
@endsection