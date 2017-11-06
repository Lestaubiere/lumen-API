<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformationRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'from', 'message',
    ];
}
