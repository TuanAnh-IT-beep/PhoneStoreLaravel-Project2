
@extends("admins.layouts.master")

@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Update a customer</h1>
    </div>
    <div class="main-container">
        <form method="post" action="{{ route('customers.update', $customer->id) }}">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <label for="name">Username:</label><br>
                    Username: <input class="mt-2 w-full" type="text" name="username" value="{{ $customer->username }}"><br>
                    Display Name: <input  class="mt-2 w-full" type="text" name="display_name" value="{{ $customer->display_name }}"><br>
                    Email: <input  class="mt-2 w-full" type="text" name="email" value="{{ $customer->email }}"><br>
                    Phone: <input class="mt-2 w-full" type="text" name="phone" value="{{ $customer->phone }}"><br>
                    Birthday: <input class="mt-2 w-full" type="date" name="birthday" value="{{ $customer->birthday }}"><br>
                    Address: <input class="mt-2 w-full" type="text" name="address" value="{{ $customer->address }}"><br>
                    <div class="flex gap-2 mt-4">
                        <button class="btn icon-only flex-1">UPDATE</button>
                        <a class="btn icon-only negative flex-1" href="{{ route('customers.index') }}">CANCEL</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
