<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.header')
    @include('layouts.head')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <div class="login_box grid grid-cols-2 mx-auto">
        <img src="/images/login/banner.png" alt="" class="image_side">
        <div class="login_side">
            <h1>Login as Administrator</h1>
            <form>
                <div class="mt-10">
                    <label for="username"> E-mail</label>
                    <input type="text" name="email" placeholder="Enter your email" class="w-full bg-white mt-1">
                </div>
                <div class="mt-3">
                    <label for="password">Password</label>
                    <input type="password" placeholder="Enter password here.." name="password"class="w-full bg-white mt-1">
                </div>
                <button class="btn icon-only w-full mt-10 blue">Login</button>
            </form>
            <div class="mt-10">
                <hr>
                <div
                    style="flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                    <img style="width: 47.99px; height: 47.99px" src="https://placehold.co/48x48" />
                    <div style="justify-content: center; display: flex; flex-direction: column"><span
                            style="color: #AFF5BF; font-size: 40px; font-family: Bmo_font; font-weight: 400; line-height: 58px; word-wrap: break-word">BMo</span><span
                            style="color: white; font-size: 40px; font-family: Bmo_font; font-weight: 400; line-height: 58px; word-wrap: break-word">bileShop</span>
                    </div>
                </div>
                </form>
                <div style="border:1px solid rgb(126, 125, 125);margin-top:30px"></div>
            </div>
        </div>
    </div>
</body>

</html>
