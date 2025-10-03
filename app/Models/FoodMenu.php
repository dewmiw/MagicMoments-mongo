<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent;

class FoodMenu extends Eloquent
{
    protected $collection = 'food_menus';

    protected $fillable = [
        'name','description','price_per_person','items'
    ];

    protected $casts = [
        'price_per_person' => 'decimal:2',
        'items' => 'array',
    ];
}
