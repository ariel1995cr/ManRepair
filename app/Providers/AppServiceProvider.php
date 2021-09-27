<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrap();
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
            \Schema::defaultStringLength(191);
        }

        \Validator::extendImplicit('current_password', function ($attribute, $value, $parameters, $validator){
            return Hash::check($value, \Auth::user()->contrasena);
        });
    }
}
