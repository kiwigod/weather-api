<?php

/** @var Router $router */

use Laravel\Lumen\Routing\Router;

$router->group(['prefix' => 'weather'], function () use ($router) {
    $router->get('/', 'WeatherController@index');
});
