<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\WeatherForecast;
use App\Mail\Contact;

class ContactController extends Controller
{
    public function sendContactMessage(Request $request)
    {
        $name = $request->all()['name'];
        $from = $request->all()['from'];
        $message = $request->all()['message'];

        Mail::to('bramvanosta@gmail.com')->send(new Contact());

        return response()->json(array('success' => true));
    }
}
