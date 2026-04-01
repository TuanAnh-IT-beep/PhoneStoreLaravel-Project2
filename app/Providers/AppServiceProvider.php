<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;




class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
    public function boot()
{
    // Load custom route file
    Route::middleware('web')
        ->group(base_path('routes/admin.php'));
        Route::middleware('web')
        ->group(base_path('routes/customer.php'));
}
}
