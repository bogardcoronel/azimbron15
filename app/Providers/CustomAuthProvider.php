<?php

namespace azimbron15\Providers;

use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use azimbron15\Auth\CustomUserProvider;
use Illuminate\Support\ServiceProvider;

class CustomAuthProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
//        Auth::extend('customUser', function($app) {
//            // Return an instance of Illuminate\Contracts\Auth\UserProvider...
//            return new CustomUserProvider(new \azimbron15\Models\Usuario());
//        });

        Auth::provider('customUser', function($app, array $config) {
            return new CustomUserProvider($config['model']);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}