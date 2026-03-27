<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.header')
    @include('layouts.head')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <div class="login_box grid grid-cols-2 gap-4">
            <div>
                <img src="/images/login/banner.png" alt="" style="height: 100%;">
            </div>
            <div style="padding-top:40px;padding-left:30px;padding-right:40px">
                <h1 style="font-size: 27px;color:black;font-weight:bold">Login as Administrator</h1>
                <div>
                    <h3 style="color:rgb(125, 124, 124)">Username or E-mail</h3>
                    <input type="text" placeholder="Enter your username" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" style="background-color:white;color:black;border-color:rgb(169, 169, 169)">
                </div>
                <div>
                    <h3 style="color:rgb(125, 124, 124)">Password</h3>
                    <input type="text" placeholder="Enter password here.." class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" style="background-color:white;color:black;border-color:rgb(169, 169, 169)">
                </div>
            </div>
    </div>
</body>
</html>
