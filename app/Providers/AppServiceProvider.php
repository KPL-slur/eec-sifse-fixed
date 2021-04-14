<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

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
        // gaperlu /Blade karena udah make use di atas
        Blade::if('is_admin', function () {
            return auth()->user()->is_admin == 1;
        });
        
        /**
         * add numberOrNa validation rule to global, message in lang\en\validation
         */
        Validator::extend('numberOrNa', function ($attribute, $value) {
             return (new \App\Rules\NumberOrNa)->passes($attribute, $value);
        });
    }
}
