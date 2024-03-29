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

// Key Random
$router->get('/key', function() {
    return str_random(32);
});

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Auth
$router->post('login', 'UserController@authenticate');

$router->get('checklist', 'ChecklistController@index');
$router->get('checklist/{id}', 'ChecklistController@show');
$router->post('checklist', 'ChecklistController@store');
$router->post('checklist/update/{id}', 'ChecklistController@update');
$router->delete('checklist/{id}', 'ChecklistController@delete');

