<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent;

class MusicCategory extends Eloquent
{
    protected $collection = 'music_categories';

    protected $fillable = [
        'name','description','price'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];
}
