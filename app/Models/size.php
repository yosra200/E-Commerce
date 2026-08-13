<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class size extends Model
{
    protected $fillable = [
        'name',
        'sort_order'
    ];

    protected $casts = [
        'name' => 'array'
    ];
}
