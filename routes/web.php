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

// $router->get('/gmaps', 'LocationController@location');

// Api Route

// Auth API
$router->get('api/login', 'AuthController@loginUser');
$router->get('api/register', 'AuthController@registerUser');
