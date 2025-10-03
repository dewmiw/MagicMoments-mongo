<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent;

class Booking extends Eloquent
{
    // Optional if your default connection is already 'mongodb'
    // protected $connection = 'mongodb';

    protected $collection = 'bookings';

    protected $fillable = [
        'name','email','phone',
        'event_type','event_date','guests',
        'food_pref','music_pref','deco_pref',
        'notes','images'
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'images'     => 'array',
        'guests'     => 'integer',
    ];
}
