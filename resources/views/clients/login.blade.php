<!DOCTYPE html>
<html lang="en">

<head>

    @include('clients.layouts.head')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <title>Login - BMobileShop</title>
</head>

<body>
    @include('clients.layouts.header')
    <div class="container login_box grid grid-cols-2 mx-auto">
        <img src="/images/login/banner.png" alt="" class="image_side">
        <div class="login_side">
            <h1>Login</h1>
            <form action="" method="post">
                @csrf
                <div class="mt-10">
                    <label for="login">Username or E-mail</label>
                    <input type="text" name="login" placeholder="Enter your username or e-mail here..."
                        class="w-full bg-white mt-1">
                </div>
                <div class="mt-3">
                    <label for="password">Password</label>
                    <input type="password" placeholder="Enter password here.."
                        name="password"class="w-full bg-white mt-1">
                </div>
                <button class="btn icon-only w-full mt-10 blue">Login</button>
                <label class="block w-full text-center my-2">or...</label>
                <a class="btn icon-only w-full green" href="{{ route('register') }}">Sign up</a>

            </form>
            <hr class="mt-10">
            <div class="my-5 flex flex-col items-center justify-center">
                <img src="{{ asset('images/main/Logo.png') }}" alt="Logo" class="logo-image">
                <p class="logo-text"><span style="color: #AFF5BF;">BMo</span>bileShop</a></p>
            </div>
            <hr>
        </div>
    </div>
</body>

</html>
