<?php

namespace App\Http\Controllers;

class ZooverController extends Controller
{
    public function getZooverInfo()
    {
      $client = new \GuzzleHttp\Client();
      $res = $client->request('GET', 'http://www.zoover.co.uk/widgets/loadwidgetdynamiccontent.aspx?entid=83259&entlvl=accommodation&widgetType=3&position=widgets-content-83259-3&generalScore=true');

      $content = $res->getBody()->getContents();

      preg_match("/score-value..>(...)<\/span>?/", $content, $score);

      preg_match("/(...) reviews/", $content, $reviews);

      $result = array(
        "score" => $score[1],
        "reviews" => $reviews[1]
      );

      return response()->json($result);
    }
}
