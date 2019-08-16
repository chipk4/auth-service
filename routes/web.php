<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'auth'], function() use ($router) {
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');
});

//use custom guard
$router->group(['prefix' => 'user', 'middleware' => 'auth'], function() use ($router) {
    $router->get('/{id:[0-9]+}', function () {
        return 'get user'; // return user entity
    });
});

$router->group(['prefix' => 'analytic'], function () use ($router) {
    //track action
});
