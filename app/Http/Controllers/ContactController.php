<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\InformationRequest;
use App\Mail\Contact;

class ContactController extends Controller
{
    public function sendContactMessage(Request $request)
    {
        if ($request->has('name') && $request->has('email') && $request->has('message')) {
            $name = $request->all()['name'];
            $from = $request->all()['email'];
            $message = $request->all()['message'];
    
            InformationRequest::updateOrCreate(
                ['name' => $name],
                ['from' => $from],
                ['message' => $message]
            );
    
            Mail::to('bramvanosta@gmail.com')->send(new Contact($name, $from, $message));
    
            if (Mail::failures()) {
                return response()->json([], 500);
            }
    
            return response()->json([], 200);
        }

        return response()->json([], 500);
    }
}
