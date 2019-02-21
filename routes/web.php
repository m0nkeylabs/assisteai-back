<?php

// home
$router->get('/', 'HomeController@index');
$router->get('/', [
    'uses' => 'HomeController@index',
    'middleware' => 'auth',
]);

// auth
$router->post('/auth/login', 'AuthController@authenticate');
$router->get('/auth/me', 'AuthController@me');

$router->get('movies', 'MoviesController@index');

