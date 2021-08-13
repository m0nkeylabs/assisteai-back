<?php

// home
$router->get('/', 'HomeController@index');

// auth
$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->get('me', ['uses' => 'AuthController@me', 'middleware' => 'auth']);
    $router->get('logout', ['uses' => 'AuthController@logout', 'middleware' => 'auth']);
    $router->post('refresh', ['uses' => 'AuthController@refresh']);

    // login
    $router->post('login', 'AuthController@authenticate');
    $router->post('login/{provider}', 'AuthController@authenticateWithProvider');
});

// profile
$router->put('users', ['uses' => 'AuthController@update', 'middleware' => 'auth']);
$router->post('users/avatar', ['uses' => 'AuthController@avatar', 'middleware' => 'auth']);

// movies
$router->get('movies', 'MoviesController@index');
$router->get('movies/random', 'MoviesController@randomMovie');
$router->get('movies/{id}', 'MoviesController@details');
$router->post('movies/ratings', ['uses' => 'RatingsController@store', 'middleware' => 'auth']);

// watch later
$router->get('watch-later', ['uses' => 'WatchLaterController@all', 'middleware' => 'auth']);
$router->post('watch-later', ['uses' => 'WatchLaterController@store', 'middleware' => 'auth']);
$router->delete('watch-later/{movie_id}', ['uses' => 'WatchLaterController@destroy', 'middleware' => 'auth']);

// sync
$router->get('sync', ['uses' => 'SyncMoviesController@sync']);
