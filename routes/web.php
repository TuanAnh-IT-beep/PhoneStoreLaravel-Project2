<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SpecController;
use App\Http\Controllers\SubproductController;
use App\Http\Controllers\SubSpecController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\CheckUserLogin;

Route::resource('permissions', PermissionController::class)->middleware(CheckUserLogin::class);
Route::resource('roles', RoleController::class)->middleware(CheckUserLogin::class);
Route::resource('customers', CustomerController::class)->middleware(CheckUserLogin::class);
Route::resource('payment_methods', PaymentMethodController::class)->middleware(CheckUserLogin::class);
Route::resource('categories', CategoryController::class)->middleware(CheckUserLogin::class);
Route::resource('manufacturers', ManufacturerController::class)->middleware(CheckUserLogin::class);
Route::resource('specs', SpecController::class)->middleware(CheckUserLogin::class);
Route::resource('orders', OrderController::class)->middleware(CheckUserLogin::class);
Route::resource('orderdetails', OrderDetailController::class)->middleware(CheckUserLogin::class);
Route::resource('products', ProductController::class)->middleware(CheckUserLogin::class);
Route::resource('productimagies', ProductImageController::class)->middleware(CheckUserLogin::class);
Route::resource('rolepermissions', RolePermissionController::class)->middleware(CheckUserLogin::class);
Route::resource('products', ProductController::class)->middleware(CheckUserLogin::class);
Route::resource('subproducts', SubproductController::class)->middleware(CheckUserLogin::class);
Route::resource('subspecs', SubSpecController::class)->middleware(CheckUserLogin::class);
Route::resource('users', UserController::class)->middleware(CheckUserLogin::class);
Route::get('/', function () {
    return view('admins.index');
})->name('home')->middleware(CheckUserLogin::class);
Route::get('/login', [UserController::class,'login'])
->name('admins.users.login');
Route::post('/login', [UserController::class,'loginProcess'])
->name('admins.users.login');
Route::get('/logout',[UserController::class,'logout'])
->name('logout');
