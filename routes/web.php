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

// eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hc3Npc3RlYWkudGVzdFwvYXV0aFwvbG9naW5cL2ZhY2Vib29rIiwiaWF0IjoxNTUxMzg5MzkzLCJleHAiOjE1NTEzOTY1OTMsIm5iZiI6MTU1MTM4OTM5MywianRpIjoiaTZsVXpCeTdxSzJNWm5JQSIsInN1YiI6MSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.Dlo4WNZ6RomHwJeeywtSNgiZ5y76v9a-yGjzDUTATJ0
