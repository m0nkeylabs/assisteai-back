<?php

// home
$router->get('/', 'HomeController@index');
$router->get('/', [
    'uses' => 'HomeController@index',
    'middleware' => 'auth',
]);

// auth
$router->post('/auth/callback[/{provider}]', 'AuthController@callback');
$router->post('/auth/login', 'AuthController@authenticate');
$router->post('/auth/login/{provider}', 'AuthController@authenticateWithProvider');
$router->get('/auth/me', 'AuthController@me');

$router->get('movies', 'MoviesController@index');

