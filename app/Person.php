<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Person extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'booking_id', 'date_birth',
    ];

    public function booking()
    {
      return $this->belongsTo('App\Booking');
    }

    public function setDateBirthAttribute($value)
    {
        $this->attributes['date_birth'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function formattedBirthDate()
    {
        return Carbon::createFromFormat('Y-m-d', $this->date_birth)
            ->diff(Carbon::createFromFormat('Y-m-d', $this->booking->date_arrival))
            ->format('%y');
    }
}
