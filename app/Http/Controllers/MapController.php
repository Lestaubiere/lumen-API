<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function getDirections(Request $request)
    {
        $MAPS_API_KEY = env('MAPS_API_KEY');
        
        $origin = $request->all()['origin'];
        $destination = $request->all()['destination'];
        
        $url = 'https://maps.googleapis.com/maps/api/directions/json?origin='.$origin.'&destination='.$destination.'&key='.$MAPS_API_KEY;

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', $url);

        $content = json_decode($res->getBody(), TRUE);
        $route = $content["routes"][0];

        $response = array(
            "markers" => array(
                $route["legs"][0]["start_location"],
                $route["legs"][0]["end_location"]
            ),
            "route" => array(
                "distance" => $route["legs"][0]["distance"]["value"],
                "duration" => $route["legs"][0]["duration"]["value"],
                "steps" => $this->formatSteps($route["legs"][0]["steps"])
            ),
            "line" => $route["overview_polyline"]["points"],
            "bounds" => $route["bounds"],
        );

        return response()->json($response);
    }

    private function formatSteps($steps)
    {
        $formattedSteps = array();

        foreach ($steps as $step) {
            $formattedSteps[] = array(
                "distance" => $step["distance"]["value"],
                "duration" => $step["duration"]["value"],
                "instruction" => $step["html_instructions"]
            );
        }

        return $formattedSteps;
    }
}
