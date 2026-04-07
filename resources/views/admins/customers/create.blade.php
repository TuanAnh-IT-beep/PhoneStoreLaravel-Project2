@extends("admins.layouts.master")
@section("main-content")
    <div class="w-full mb-4 flex items-center justify-between">
        <h1>Customers → New</h1>
    </div>
    <div class="main-container">
        <form method="post" action="{{ route('customers.store') }}">
            @csrf
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-4">
                    <label for="name">Username:</label><br>
                    <input class="my-3 w-full" type="text" name="username" placeholder="Input username here..."><br>
                    <label for="password">Password:</label><br>
                    <input class="my-3 w-full" type="password" name="password" placeholder="Input password here..."><br>
                    <label for="display_name">Display Name:</label><br>
                    <input class="my-3 w-full" type="text" name="display_name" placeholder="Input display name here..."><br>
                    <label for="email">Email:</label><br>
                    <input class="my-3 w-full" type="text" name="email" placeholder="Input email here..."><br>
                    <label for="phone">Phone:</label><br>
                    <input class="my-3 w-full" type="text" name="phone" placeholder="Input phone here..."><br>
                    <div class="flex gap-5">
                        <div class="w-full">
                            <label for="gender">Gender:</label><br>
                            <select class="w-full my-3" name="gender">
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                                <option value="O">Other</option>
                            </select><br>
                        </div>
                        <div class="w-full">
                            <label for="birthday">Birthday:</label><br>
                            <input class="my-3 w-full" type="date" name="birthday" placeholder="Input birthday here..."><br>
                        </div>
                    </div>
                    <label for="address">Address:</label><br>
                    <input class="my-3 w-full" type="text" name="address" placeholder="Input address here..."><br>
                    <input type="hidden" name="icon" value="">
                    <div class="flex gap-2 mt-4">
                        <button class="btn flex-1 icon-only">ADD</button>
                        <a class="btn flex-1 icon-only negative" href="{{ route('customers.index') }}">CANCEL</a>
                    </div>
                </div>
                <div class="col-span-6">

                </div>
            </div>
        </form>
    </div>
@endsection