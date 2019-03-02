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

// V1 routes

$router->group(['prefix' => 'v1/'], function ($router) {
    $router->group(['prefix' => 'map/'], function ($router) {
        $router->get('/directions', 'Api\V1\MapController@getDirections');
    });

    $router->group(['prefix' => 'weather/'], function ($router) {
        $router->get('/current', 'Api\V1\WeatherController@getCurrentWeather');
    });

    $router->get('/zoover', 'Api\V1\ZooverController@getZooverInfo');

    $router->get('/availabilities', 'Api\V1\AvailabilitiesController@getAvailabilities');

    $router->post('/contact', 'Api\V1\ContactController@sendContactMessage');
    
    $router->post('/booking', 'Api\V1\BookingController@createBooking');
    $router->get('/bookings', 'Api\V1\BookingController@getBookings');
});
