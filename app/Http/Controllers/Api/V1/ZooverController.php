<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;

class ZooverController extends ApiController
{
    public function getZooverInfo()
    {
      $client = new \GuzzleHttp\Client();
      $res = $client->request('GET', 'http://www.zoover.co.uk/widgets/loadwidgetdynamiccontent.aspx?entid=83259&entlvl=accommodation&widgetType=3&position=widgets-content-83259-3&generalScore=true');

      $content = $res->getBody()->getContents();

      preg_match("/score-value..>(\d+)<\/span>/", $content, $score);

      preg_match("/(\d+) reviews/", $content, $reviews);

      $result = array(
        "score" => isset($score[1]) ? $score[1] : '-',
        "reviews" => isset($reviews[1]) ? $reviews[1] : '-'
      );

      return response()->json($result);
    }
}
