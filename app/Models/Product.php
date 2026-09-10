<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uploadable;

class Product extends Model
{

    use Uploadable;
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'compare_price',
        'installation_price',
        'sku',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'name' => 'array',
        'slug' => 'array',
        'description' => 'array',
        'installation_price' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = $this->uploadFile($value, 'products');
    }

    public function getImageAttribute($value)
    {
        return $value;
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image ? asset('assets/uploads/products/' . $this->image) : '';
    }
}
