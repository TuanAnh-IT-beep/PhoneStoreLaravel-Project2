<?php
require __DIR__.'\customer.php';
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

