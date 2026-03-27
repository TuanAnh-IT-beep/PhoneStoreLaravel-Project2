<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PermissionController;
use \App\Http\Controllers\RoleController;
use \App\Http\Controllers\CustomerController;
use \App\Http\Controllers\PaymentMethodController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\ManufacturerController;
use \App\Http\Controllers\SpecController;
use \App\Http\Controllers\OrderController;
use \App\Http\Controllers\OrderDetailController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\ProductImageController;
use \App\Http\Controllers\RolePermissionController;
use \App\Http\Controllers\SubproductController;
use \App\Http\Controllers\SubSpecController;
use \App\Http\Controllers\UserController;


Route::resource('permissions', PermissionController::class);
Route::resource('roles', RoleController::class);
Route::resource('customers', CustomerController::class);
Route::resource('payment-methods', PaymentMethodController::class);
Route::resource('categories', CategoryController::class);
Route::resource('manufacturers', ManufacturerController::class);
Route::resource('specs', SpecController::class);
Route::resource('orders',OrderController::class);
Route::resource('orderdetails',OrderDetailController::class);
Route::resource('products',ProductController::class);
Route::resource('productimagies',ProductImageController::class);
Route::resource('rolepermissions',RolePermissionController::class);
Route::resource('subproducts',SubproductController::class);
Route::resource('subspecs',SubSpecController::class);
Route::resource('users',UserController::class);
Route::get('/', function () {
    return view('index');
})->name('home');
Route::get('login',function(){
    return view('Login');
})->name('login');
