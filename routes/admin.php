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
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SpecController;
use App\Http\Controllers\SubproductController;
use App\Http\Controllers\SubSpecController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckUserLogin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('admins.users.login');
    Route::post('/login', [UserController::class, 'loginProcess'])->name('admins.users.login');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});
Route::middleware(CheckUserLogin::class)->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admins.index');
    })->name('home');

    Route::get('/settings', [SettingsController::class, 'index'])->name('admins.settings.index');

    Route::resource('categories', CategoryController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('manufacturers', ManufacturerController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('orderdetails', OrderDetailController::class);
    Route::resource('payment_methods', PaymentMethodController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('products', ProductController::class);
    Route::resource('product_images', ProductImageController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('rolepermissions', RolePermissionController::class);
    Route::resource('specs', SpecController::class);
    Route::resource('subspecs', SubSpecController::class);
    Route::resource('users', UserController::class);

    Route::controller(SubproductController::class)
        ->name('subproducts.')
        ->prefix('products/{product}/subproducts')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/{subproduct}/edit', 'edit')->name('edit');
            Route::put('/{subproduct}/edit', 'update')->name('update');
            Route::delete('/{subproduct}', 'destroy')->name('destroy');
        });
});
