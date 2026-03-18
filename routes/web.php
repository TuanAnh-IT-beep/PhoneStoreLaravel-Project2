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


Route::resource('permissions', PermissionController::class);
Route::resource('roles', RoleController::class);
Route::resource('customers', CustomerController::class);
Route::resource('payment-methods', PaymentMethodController::class);
Route::resource('categories', ManufacturerController::class);
Route::resource('manufacturers', CategoryController::class);
Route::resource('specs', SpecController::class);
Route::resource('orders',OrderController::class);
Route::get('/', function () {
    return view('index');
})->name('home');
