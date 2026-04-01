<?php
use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\CheckUserLogin;

Route::get('/home', function () {
    return view('clients.index');
});
