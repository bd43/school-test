<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
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
        // Fix "Specified key was too long" error
        Schema::defaultStringLength(191);

        /* VALIDATORS */
        Validator::extend('alpha_spaces_punctuation', function($attribute, $value)
        {
            return preg_match("/^[a-zA-ZăĂâÂîÎșŞțŢ0-9 -_.,`']+$/iu", $value);
        }, 'Can only enter letters, digits, spaces and punctuation marks');

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
