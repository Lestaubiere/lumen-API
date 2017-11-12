<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'name',
        'address',
        'zip_code',
        'city',
        'country',
        'email',
        'phone_number',
        'number_pets',
        'equipment',
        'electricity',
        'date_arrival',
        'date_departure',
        'comment'
    ];

    public function setDateArrivalAttribute($value)
    {
        $this->attributes['date_arrival'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function setDateDepartureAttribute($value)
    {
        $this->attributes['date_departure'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function people()
    {
        return $this->hasMany('App\Person');
    }

    public function formattedArrivalDate()
    {
        return Carbon::createFromFormat('Y-m-d', $this->date_arrival)->format('d/m/Y');
    }

    public function formattedDepartureDate()
    {
        return Carbon::createFromFormat('Y-m-d', $this->date_departure)->format('d/m/Y');
    }
}
