<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PermissionController;
use \App\Http\Controllers\RoleController;
use \App\Http\Controllers\CustomerController;
use \App\Http\Controllers\PaymentMethodController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\ManufacturerController;
use \App\Http\Controllers\SpecController;



Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
Route::post('/permissions/create', [PermissionController::class, 'store'])->name('permissions.store');
Route::put('/permissions/{permission}/edit', [PermissionController::class, 'update'])->name('permissions.update');
Route::delete('/permissions/{permission}/delete', [PermissionController::class, 'destroy'])->name('permissions.delete');

Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
Route::post('/roles/create', [RoleController::class, 'store'])->name('roles.store');
Route::put('/roles/{role}/edit', [RoleController::class, 'update'])->name('roles.update');
Route::delete('/roles/{role}/delete', [RoleController::class, 'destroy'])->name('roles.delete');

Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
Route::post('/customers/create', [CustomerController::class, 'store'])->name('customers.store');
Route::put('/customers/{customer}/edit', [CustomerController::class, 'update'])->name('customers.update');
Route::delete('/customers/{customer}/delete', [CustomerController::class, 'destroy'])->name('customers.delete');

Route::get('/payment-methods', [PaymentMethodController::class, 'index'])->name('payment_methods.index');
Route::get('/payment-methods/create', [PaymentMethodController::class, 'create'])->name('payment_methods.create');
Route::get('/payment-methods/{payment-method}/edit', [PaymentMethodController::class, 'edit'])->name('payment_methods.edit');
Route::post('/payment-methods/create', [PaymentMethodController::class, 'store'])->name('payment_methods.store');
Route::put('/payment-methods/{payment-method}/edit', [PaymentMethodController::class, 'update'])->name('payment_methods.update');
Route::delete('/payment-methods/{payment-method}/delete', [PaymentMethodController::class, 'destroy'])->name('payment_methods.delete');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/categories/create', [CategoryController::class, 'store'])->name('categories.store');
Route::put('/categories/{category}/edit', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}/delete', [CategoryController::class, 'destroy'])->name('categories.delete');

Route::get('/manufacturers', [ManufacturerController::class, 'index'])->name('manufacturers.index');
Route::get('/manufacturers/create', [ManufacturerController::class, 'create'])->name('manufacturers.create');
Route::get('/manufacturers/{manufacturer}/edit', [ManufacturerController::class, 'edit'])->name('manufacturers.edit');
Route::post('/manufacturers/create', [ManufacturerController::class, 'store'])->name('manufacturers.store');
Route::put('/manufacturers/{manufacturer}/edit', [ManufacturerController::class, 'update'])->name('manufacturers.update');
Route::delete('/manufacturers/{manufacturer}/delete', [ManufacturerController::class, 'destroy'])->name('manufacturers.delete');

Route::get('/specs', [SpecController::class, 'index'])->name('specs.index');
Route::get('/specs/create', [SpecController::class, 'create'])->name('specs.create');
Route::get('/specs/{spec}/edit', [SpecController::class, 'edit'])->name('specs.edit');
Route::post('/specs/create', [SpecController::class, 'store'])->name('specs.store');
Route::put('/specs/{spec}/edit', [SpecController::class, 'update'])->name('specs.update');
Route::delete('/specs/{spec}/delete', [SpecController::class, 'destroy'])->name('specs.delete');

