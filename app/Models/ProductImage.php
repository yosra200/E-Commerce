<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uploadable;
use Override;

class ProductImage extends Model
{
    use Uploadable;

    protected $fillable = [
        'product_id',
        'image',
        'color_id',
        'is_primary',
        'sort_order',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = $this->uploadFile($value, 'products');
    }

    public function getImageAttribute($value)
    {
        return $value ? asset('assets/uploads/products/' . $value) : '';
    }
}
