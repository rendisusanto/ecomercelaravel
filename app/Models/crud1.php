<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class crud1 extends Model
{
     protected $fillable = [
        'image',
        'title',
        'description',
        'price',
        'stock',
    ];
}
