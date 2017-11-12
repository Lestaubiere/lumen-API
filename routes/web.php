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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'v1/'], function ($router) {
    $router->group(['prefix' => 'map/'], function ($router) {
        $router->get('/directions', 'MapController@getDirections');
    });

    $router->group(['prefix' => 'weather/'], function ($router) {
        $router->get('/current', 'WeatherController@getCurrentWeather');
    });

    $router->get('/zoover', 'ZooverController@getZooverInfo');

    $router->post('/contact', 'ContactController@sendContactMessage');
    
    $router->post('/booking', 'BookingController@createBooking');
});
