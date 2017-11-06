<?php

namespace App\Http\Controllers;

class WeatherController extends Controller
{
    public function getCurrentWeather()
    {
        // Fetch database to check time of latest request
        // If latest request is older than 1h -> fetch new data from API and store in database
        // Else -> fetch data from database

        $url = 'https://api.openweathermap.org/data/2.5/weather?lat=44.992392&lon=0.598711&APPID=1da70e9c1c50aae0675a73f4915fe473&units=metric';
        
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
