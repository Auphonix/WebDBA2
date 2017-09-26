<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // Added a custom validation for forms
        Validator::extend('alpha_spaces', function($attribute, $value)
        {
            return preg_match('/^[a-zA-Z0-9 .]+$/', $value);
        });

        // Prevents an error regarding SQL String lengths
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
