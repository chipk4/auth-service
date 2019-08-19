<?php

namespace App\Providers;

use App\Extensions\AccessTokenGuard;
use App\Extensions\TokenToUserProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
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
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        Auth::extend('access_token', function ($app, $name, array $config) {
            // automatically build the DI, put it as reference
            $userProvider = app(TokenToUserProvider::class);
            $request = app('request');

            return new AccessTokenGuard($userProvider, $request, $config);
        });
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.
//        $this->app['auth']->viaRequest('api', function ($request) {
//            var_dump('api key'); die();
//            if ($request->input('api_key')) {
//
//                //search for api key in keys repository
////                return User::where('api_key', $request->input('api_key'))->first();
//            }
//        });
    }
}
