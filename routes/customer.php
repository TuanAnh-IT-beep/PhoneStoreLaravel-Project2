<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SettingsController;
use App\Http\Middleware\CheckClientLogin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/login', [CustomerController::class, 'login'])
    ->name('clients.login');
Route::post('/login', [CustomerController::class, 'loginProcess'])
    ->name('clients.login');
Route::get('/logout', [CustomerController::class, 'logout'])
    ->name('logout');
    Route::get('/register',[CustomerController::class,'register'])
    ->name('register');
Route::post('/register', [CustomerController::class,'registerProcess'])
->name('register');
Route::get('/profile',[CustomerController::class,'viewProfile'])->name('profile');
Route::get('/update',[CustomerController::class,'getProfile'])->name('getProfile');
Route::put('/update',[CustomerController::class, 'updateProfile'])->name('updateProfile');
Route::get('/view', [HomeController::class, 'showAll'])->name('all');
Route::get('/category/{cateid}', [HomeController::class, 'showByCategory'])->name('viewbycategory');
Route::get('/items/{id}', [HomeController::class, 'showById'])->name('viewbyid');
Route::get('/details/{proid}/{subid}', [HomeController::class, 'detail'])->name('detail');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart')->middleware(CheckClientLogin::class);
Route::get('/addtocart/{subproduct}', [CartController::class, 'addToCart'])->name('add')->middleware(CheckClientLogin::class);
Route::get('/removeincart/{subproduct}', [CartController::class, 'removeProduct'])->name('remove');
Route::get('/removeallcart', [CartController::class, 'deleteCart'])->name('removeall');
Route::get('/plus/{subproduct}', [CartController::class, 'plus'])->name('plus');
Route::get('/minus/{subproduct}', [CartController::class, 'minus'])->name('minus');
Route::get('/order_confirm', [OrderController::class, 'orderConfirm'])->name('orderConfirm');
Route::get('/orders', [OrderController::class, 'showinClient'])->name('orders');
Route::post('/confirm', [OrderController::class, 'placeOrder'])->name('order.confirm');
Route::put('/cancel/{id}',[OrderController::class,'OrderCancel'])->name('order.cancel');
Route::put('/change',[CustomerController::class,'changePassword'])->name('changePass');
