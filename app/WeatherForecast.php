<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeatherForecast extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'temperature', 'code',
    ];
}
