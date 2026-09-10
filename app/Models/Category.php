<?php

namespace App\Models;

use App\Traits\Uploadable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

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

    public function setSlugAttribute($value): void
    {
        $base = $value;

        if (blank($base)) {
            $base = $this->name;

            if (is_array($base)) {
                $base = $base['en'] ?? $base['ar'] ?? '';
            }
        }

        $this->attributes['slug'] = Str::slug((string) $base);
    }

    protected $casts = [
        // 'name' => 'JSON',
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
