<?php

namespace App\Http\Controllers;

use Log;

use App\WeatherForecast;

class WeatherController extends Controller
{
    public function getCurrentWeather()
    {
        $lastWeatherForecast = WeatherForecast::whereRaw('created_at >= NOW() - INTERVAL 1 HOUR')->first();

        if ($lastWeatherForecast) {
            Log::info('Using weather forecast from database');

            $response = array(
                "temperature" => $lastWeatherForecast['temperature'],
                "code" => $lastWeatherForecast['code']
            );
        } else {
            Log::info('Fetching new weather forecast');

            $OPENWEATHERMAP_API_KEY = env('OPENWEATHERMAP_API_KEY');
            $url = 'https://api.openweathermap.org/data/2.5/weather?lat=44.992392&lon=0.598711&APPID='.$OPENWEATHERMAP_API_KEY.'&units=metric';
            
            $client = new \GuzzleHttp\Client();
            $res = $client->request('GET', $url);
    
            $content = json_decode($res->getBody(), TRUE);
    
            $response = array(
                "temperature" => round($content["main"]["temp"]),
                "code" => $content["weather"][0]["id"]
            );

            WeatherForecast::updateOrCreate(
                ['temperature' => $response['temperature']],
                ['code' => $response['code']]
            );
        }

        return response()->json($response);
    }
}
