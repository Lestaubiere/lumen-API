<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Api\ApiController;
use App\Booking;
use App\Person;
use App\Mail\Booking as BookingMail;

class BookingController extends ApiController
{
    public function createBooking(Request $request)
    {
        if ($request->has('title') &&
            $request->has('name') &&
            $request->has('address') &&
            $request->has('zip_code') &&
            $request->has('city') &&
            $request->has('country') &&
            $request->has('email') &&
            $request->has('phone_number') &&
            $request->has('people') &&
            $request->has('number_pets') &&
            $request->has('equipment') &&
            $request->has('electricity') &&
            $request->has('date_arrival') &&
            $request->has('date_departure') &&
            $request->has('comment'))
        {
            $title = $request->all()['title'];
            $name = $request->all()['name'];
            $address = $request->all()['address'];
            $zip_code = $request->all()['zip_code'];
            $city = $request->all()['city'];
            $country = $request->all()['country'];
            $email = $request->all()['email'];
            $phone_number = $request->all()['phone_number'];
            $people = $request->all()['people'];
            $number_pets = $request->all()['number_pets'];
            $equipment = $request->all()['equipment'];
            $electricity = $request->all()['electricity'];
            $date_arrival = $request->all()['date_arrival'];
            $date_departure = $request->all()['date_departure'];
            $comment = $request->all()['comment'];

            if (strtotime($date_departure) < strtotime($date_arrival)) {
                var_dump(strtotime($date_departure));
                return response()->json(["error" => "DEPARTURE_BEFORE_ARRIVAL"], 500);
            }

            if (count($people) < 1) {
                return response()->json(["error" => "NO_PEOPLE"], 500);
            }
    
            $booking = new Booking([
                'title' => $title,
                'name' => $name,
                'address' => $address,
                'zip_code' => $zip_code,
                'city' => $city,
                'country' => $country,
                'email' => $email,
                'phone_number' => $phone_number,
                'number_pets' => $number_pets,
                'equipment' => $equipment,
                'electricity' => $electricity,
                'date_arrival' => $date_arrival,
                'date_departure' => $date_departure,
                'comment' => $comment
            ]);

            $booking->save();

            foreach ($people as $person) {
                $person = new Person([
                    'booking_id' => $booking->id,
                    'date_birth' => $person
                ]);
                $person->save();
            }
    
            Mail::to('bramvanosta@gmail.com')->send(new BookingMail($booking));
    
            if (Mail::failures()) {
                return response()->json(["error" => "MAIL_FAILURE"], 500);
            }
    
            return response()->json($booking, 200);
        }

        return response()->json(["error" => "INCOMPLETE_FORM"], 500);
    }
}
