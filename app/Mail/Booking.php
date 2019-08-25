<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class Booking extends Mailable
{
    public $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@camping-lestaubiere.fr', 'New booking from Lestaubiere - Season '. $this->booking->seasonYear() . ' - ' . $this->booking->title . ' ' . $this->booking->name)
                    ->view('BookingEmail');
    }
}
