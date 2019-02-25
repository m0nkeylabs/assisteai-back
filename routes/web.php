<?php

// home
$router->get('/', 'HomeController@index');

// auth
$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->get('me', ['uses' => 'AuthController@me', 'middleware' => 'auth']);
    $router->get('refresh', ['uses' => 'AuthController@refresh', 'middleware' => 'auth']);
    $router->get('logout', ['uses' => 'AuthController@logout', 'middleware' => 'auth']);

    // login
    $router->post('login', 'AuthController@authenticate');
    $router->post('login/{provider}', 'AuthController@authenticateWithProvider');
});


// movies
$router->get('movies', 'MoviesController@index');

