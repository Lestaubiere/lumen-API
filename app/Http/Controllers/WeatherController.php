<?php

namespace App\Http\Controllers;

class WeatherController extends Controller
{
    public function getCurrentWeather()
    {
        // Fetch database to check time of latest request
        // If latest request is older than 1h -> fetch new data from API and store in database
        // Else -> fetch data from database
        $OPENWEATHERMAP_API_KEY = env('OPENWEATHERMAP_API_KEY');

        $url = 'https://api.openweathermap.org/data/2.5/weather?lat=44.992392&lon=0.598711&APPID='.$OPENWEATHERMAP_API_KEY.'&units=metric';
        
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', $url);

        $content = json_decode($res->getBody(), TRUE);

        $response = array(
            "temperature" => round($content["main"]["temp"]),
            "code" => $content["weather"][0]["id"]
        );

        return response()->json($response);
    }
}
