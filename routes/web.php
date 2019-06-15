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

$router->post('login', 'UserController@authenticate');
$router->get('product', 'ProductController@index');
$router->get('product/{id}', 'ProductController@show');
$router->post('product/create', 'ProductController@store');
$router->post('product/update/{id}', 'ProductController@update');
$router->post('product/delete/{id}', 'ProductController@delete');

