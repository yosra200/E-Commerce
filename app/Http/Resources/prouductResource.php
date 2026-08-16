<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class prouductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $comparePrice = $this->compare_price !== null ? (float) $this->compare_price : null;
        $price = (float) $this->price;
        $discount = $comparePrice && $comparePrice > $price
            ? (int) round((($comparePrice - $price) / $comparePrice) * 100)
            : 0;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'sku' => $this->sku,
            'price' => $price,
            'compare_price' => $comparePrice,
            'discount_percentage' => $discount,
            'is_active' => $this->is_active,
            'category_id' => $this->category_id,
            'category_name' => $this->whenLoaded('category', fn () => $this->category->name),
            'category' => $this->whenLoaded('category', fn () => [
                'id' => $this->category->id,
                'name' => $this->category->name,
                'slug' => $this->category->slug,
            ]),
            'images' => $this->whenLoaded('images', fn () => $this->images->map(fn ($image) => [
                'id' => $image->id,
                'image' => $image->image,
                'url' => asset('storage/' . $image->image),
                'is_primary' => $image->is_primary,
                'sort_order' => $image->sort_order,
                'color' => $image->color ? [
                    'id' => $image->color->id,
                    'name' => $image->color->name,
                    'code' => $image->color->code,
                ] : null,
            ])->values()),
            'variants' => $this->whenLoaded('variants', fn () => $this->variants->map(fn ($variant) => [
                'id' => $variant->id,
                'sku' => $variant->sku,
                'price' => $variant->price !== null ? (float) $variant->price : null,
                'stock' => $variant->stock,
                'is_active' => $variant->is_active,
                'color' => [
                    'id' => $variant->color->id,
                    'name' => $variant->color->name,
                    'code' => $variant->color->code,
                ],
                'size' => [
                    'id' => $variant->size->id,
                    'name' => $variant->size->name,
                    'sort_order' => $variant->size->sort_order,
                ],
            ])->values()),
        ];
    }
}
