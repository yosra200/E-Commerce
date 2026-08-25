<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class ServiceRequest extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'category_id',
        'location_details',
        'latitude',
        'longitude',
        'google_maps_url',
        'status',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
