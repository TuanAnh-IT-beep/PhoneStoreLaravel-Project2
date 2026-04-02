<?php
use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\CheckClientLogin;
use App\Http\Controllers\CustomerController;

Route::get('/home', function () {
    return view('clients.index');
})->name('home')->middleware(CheckClientLogin::class);
Route::get('/login', [CustomerController::class,'login'])
->name('clients.login');
Route::post('/login', [CustomerController::class,'loginProcess'])
->name('clients.login');
Route::get('/logout',[CustomerController::class,'logout'])
->name('logout');
