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
    return "This is a test task for socialtech";
});

$router->group(['prefix' => 'auth'], function() use ($router) {
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');
});

//use custom guard
$router->group(['prefix' => 'user', 'middleware' => 'auth:token'], function() use ($router) {
    $router->get('/{id:[a-zA-Z]+}', 'ExampleController@testUser');
});

$router->group(['prefix' => 'analytic', 'middleware' => ['session', 'auth:optional_auth']], function () use ($router) {
    $router->get('/track', 'AnalyticsController@trackAction');
});
