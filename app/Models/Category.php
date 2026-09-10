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

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function setSlugAttribute($value): void
    {
        $base = blank($value)
            ? (
                is_array($this->name)
                ? ($this->name['en'] ?? $this->name['ar'] ?? '')
                : ($this->name ?? '')
            )
            : $value;

        $this->attributes['slug'] = Str::slug((string) $base);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = $this->uploadFile($value, 'categories');
    }

    public function getImageAttribute($value)
    {
        return $value;
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image ? asset('assets/uploads/categories/' . $this->image) : '';
    }
}
