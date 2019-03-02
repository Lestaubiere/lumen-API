<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;

use App\Http\Controllers\Api\ApiController;

class AvailabilitiesController extends ApiController
{
    public function getAvailabilities(Request $request)
    {
        $SHEETY_UID = env('SHEETY_UID');
        $url = 'https://api.sheety.co/'.$SHEETY_UID;

        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('GET', $url);
        } catch (\Exception $e) {
            return response()->json(null);
        }

        $content = json_decode($response->getBody(), TRUE);

        if (null == $content || count($content) === 0) {
            return response()->json(null);
        }

        if (isset($content[0])) {
            $columns = [];

            foreach (array_keys($content[0]) as $column) {
                if ($column !== '') {
                    $columns[] = $column;
                }
            }
        }

        $rows = [];

        foreach($content as $item) {
            $row = [
                'data' => [],
            ];

            if (isset($item[''])) {
                $row['title'] = $item[''];
            }

            foreach ($item as $data) {
                if (is_bool($data)) {
                    $row['data'][] = $data;
                }
            }

            $rows[] = $row;
        }

        return response()->json([
            'columns' => $columns,
            'rows' => $rows
        ]);
    }
}
