<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
    return "Spotify Lumen + VueJs -- {$router->app->version()}";
});

$router->post('/register', 'UserController@register');
$router->post('/login', 'UserController@authentication');

$router->group(['prefix' => 'users'], function () use ($router){
    $router->get('/', 'UserController@index');
    $router->get('/{id}', 'UserController@show');


});
