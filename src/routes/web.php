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
    return $router->app->version();
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    #http://localhost:8000/api/v1/usuarios

    $router->post('/usuarios', 'UsuarioController@create');
    $router->get('/login', 'UsuarioController@authenticate');
    $router->post('/eventos', 'EventoController@store');
    $router->get('/eventos', 'EventoController@index');
    $router->get('/eventos/{id}', 'EventoController@show');


    // $router->get('/usuarios', 'UsuarioController@index');
    // $router->put('/usuarios/{id}', 'UsuarioController@update');
    // $router->delete('/usuarios/{id}', 'UsuarioController@destroy');
});
