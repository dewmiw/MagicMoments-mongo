<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent;

class DecorationCategory extends Eloquent
{
    protected $collection = 'decoration_categories';

    protected $fillable = [
        'name','description','price'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];
}
