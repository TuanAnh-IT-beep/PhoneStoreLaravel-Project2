<?php
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\CheckClientLogin;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(CheckClientLogin::class);
Route::get('/login', [CustomerController::class,'login'])
->name('clients.login');
Route::post('/login', [CustomerController::class,'loginProcess'])
->name('clients.login');
Route::get('/logout',[CustomerController::class,'logout'])
->name('logout');
Route::get('/settings', [SettingsController::class, 'index'])->name('admins.settings.index');
Route::get('/all',[HomeController::class,'showAll'])->name('all')->middleware(CheckClientLogin::class);
Route::get('/{id}/view',[HomeController::class,'showByCategory'])->name('view')->middleware(CheckClientLogin::class);
Route::get('/{id}/viewbyid', [HomeController::class,'showById'])->name('viewbyid')->middleware(CheckClientLogin::class);
Route::get('/{proid}/{subid}/details', [HomeController::class, 'detail'])->name('detail')->middleware(CheckClientLogin::class);
Route::get('/cart', [CartController::class, 'showCart'])->name('cart')->middleware(CheckClientLogin::class);
Route::get('/addtocart/{subproduct}', [CartController::class, 'addToCart'])->name('add');
Route::get('/removeincart/{subproduct}', [CartController::class, 'removeProduct'])->name('remove');
Route::get('/removeallcart', [CartController::class, 'deleteCart'])->name('removeall');
Route::get('/plus/{subproduct}', [CartController::class, 'plus'])->name('plus');
Route::get('/minus/{subproduct}', [CartController::class, 'minus'])->name('minus');
