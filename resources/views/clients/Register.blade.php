<!DOCTYPE html>
<html lang="en">

<head>

    @include('clients.layouts.head')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <title>Register - BMobileShop</title>
</head>

<body>
    @include('clients.layouts.header')
    <div class="pb-10">
        <div class="login_box grid grid-cols-2 mx-auto" style="width: 1150px">
            <img src="/images/login/banner.png" alt="" class="image_side">
            <div class="login_side">
                <h1>Register</h1>
                <form method="post" action="{{ route('register') }}">
                    @csrf
                    <div class="mt-5">
                        <label for="name">Username:</label><br>
                        <input required class="mt-1 mb-3 w-full" type="text" name="username"
                            placeholder="Input username here..."><br>
                        <label for="password">Password:</label><br>
                        <input required class="mt-1 mb-3 w-full" type="password" name="password"
                            placeholder="Input password here..."><br>
                        <label for="display_name">Display Name:</label><br>
                        <input required class="mt-1 mb-3 w-full" type="text" name="display_name"
                            placeholder="Input display name here..."><br>
                        <label for="email">Email:</label><br>
                        <input required class="mt-1 mb-3 w-full" type="text" name="email"
                            placeholder="Input email here..."><br>
                        <label for="phone">Phone:</label><br>
                        <input required class="mt-1 mb-3 w-full" type="text" name="phone"
                            placeholder="Input phone here..."><br>
                        <div class="flex gap-5 mb-3">
                            <div class="w-full">
                                <label for="gender">Gender:</label><br>
                                <select class="w-full mt-1" name="gender">
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                    <option value="O">Other</option>
                                </select><br>
                            </div>
                            <div class="w-full">
                                <label for="birthday">Birthday:</label><br>
                                <input class="mt-1 w-full" type="date" name="birthday"
                                    placeholder="Input birthday here..."><br>
                            </div>
                        </div>
                        <label for="address">Address:</label><br>
                        <input class="mt-1 w-full" type="text" name="address"
                            placeholder="Input address here..."><br>
                        <input type="hidden" name="icon" value="">
                        <div class="flex gap-2 mt-4">
                            <button class="btn flex-1 icon-only">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
