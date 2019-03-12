<?php

// home
$router->get('/', 'HomeController@index');

// auth
$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->get('me', ['uses' => 'AuthController@me', 'middleware' => 'auth']);
    $router->get('logout', ['uses' => 'AuthController@logout', 'middleware' => 'auth']);
    $router->get('refresh', ['uses' => 'AuthController@refresh']);

    // login
    $router->post('login', 'AuthController@authenticate');
    $router->post('login/{provider}', 'AuthController@authenticateWithProvider');
});


// movies
$router->get('movies', 'MoviesController@index');
$router->post('movies', ['uses' => 'MoviesController@store', 'middleware' => 'auth']);

// watch later
$router->post('watch-later', ['uses' => 'WatchLaterController@store', 'middleware' => 'auth']);
$router->delete('watch-later/{movie_id}', ['uses' => 'WatchLaterController@destroy', 'middleware' => 'auth']);
