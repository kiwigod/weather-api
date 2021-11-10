<?php

/** @var Router $router */

use Laravel\Lumen\Routing\Router;

$router->group(['prefix' => 'user'], function () use ($router) {
    $router->post('/', 'UserCreationController@create');
    $router->post('/auth', 'UserAuthController@auth');

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->get('/', 'UserController@index');
    });
});
