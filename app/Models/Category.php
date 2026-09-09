<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Traits\Uploadable;

class Category extends Model
{
    use Uploadable, HasTranslations;
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'image',
        'is_active',
        'sort_order'
    ];
    public array $translatable = ['name'];

    protected $casts = [
        // 'name' => 'JSON',
        // 'slug' => 'array',
        'is_active' => 'boolean'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }


    public function setimageAttribute($value)
    {
        $this->attributes['image'] = $this->uploadFile($value, 'categories');
    }


    public function getImageAttribute()
    {
        return $this->image ? asset('assets/uploads/categories/' . $this->image) : '';
    }
}
