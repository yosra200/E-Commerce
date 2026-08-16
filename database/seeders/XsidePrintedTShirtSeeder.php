<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Database\Seeder;

class XsidePrintedTShirtSeeder extends Seeder
{
    public function run(): void
    {
        $men = Category::firstOrCreate(
            ['slug->en' => 'men'],
            [
                'name' => ['en' => 'Men', 'ar' => 'رجال'],
                'slug' => ['en' => 'men', 'ar' => 'رجال'],
                'is_active' => true,
                'sort_order' => 2,
            ],
        );

        $clothing = Category::firstOrCreate(
            ['slug->en' => 'men-clothing'],
            [
                'parent_id' => $men->id,
                'name' => ['en' => 'Clothing', 'ar' => 'ملابس'],
                'slug' => ['en' => 'men-clothing', 'ar' => 'ملابس-رجال'],
                'is_active' => true,
                'sort_order' => 1,
            ],
        );

        $tShirts = Category::firstOrCreate(
            ['slug->en' => 'men-t-shirts'],
            [
                'parent_id' => $clothing->id,
                'name' => ['en' => 'T-Shirts', 'ar' => 'تي شيرتات'],
                'slug' => ['en' => 'men-t-shirts', 'ar' => 'تي-شيرتات-رجال'],
                'is_active' => true,
                'sort_order' => 1,
            ],
        );

        $color = Color::firstOrCreate(
            ['code' => '#F4F4F4'],
            [
                'name' => ['en' => 'Buxe White', 'ar' => 'أبيض بوكس'],
                'image' => null,
            ],
        );

        $sizes = collect([
            'S' => 2,
            'M' => 3,
            'L' => 4,
            'XL' => 5,
        ])->mapWithKeys(function (int $sortOrder, string $name) {
            $size = Size::firstOrCreate(
                ['name->en' => $name],
                ['name' => ['en' => $name, 'ar' => $name], 'sort_order' => $sortOrder],
            );

            return [$name => $size];
        });

        $product = Product::updateOrCreate(
            ['sku' => 'S6NN95Z8-Q6K'],
            [
                'category_id' => $tShirts->id,
                'name' => [
                    'en' => "XSIDE Crew Neck Printed Men's T-Shirt",
                    'ar' => 'تيشيرت رجالي مطبوع بياقة دائرية XSIDE',
                ],
                'description' => [
                    'en' => 'Regular-fit crew neck, short sleeve men\'s t-shirt with a front slogan print. Made from 100% cotton jersey fabric.',
                    'ar' => 'تيشيرت رجالي بقصة عادية، بياقة دائرية وأكمام قصيرة، بطباعة أمامية. مصنوع من قماش جيرسي 100% قطن.',
                ],
                'price' => 299.00,
                'compare_price' => 499.00,
                'is_active' => true,
                'sort_order' => 2,
            ],
        );

        foreach ($sizes as $name => $size) {
            ProductVariant::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'color_id' => $color->id,
                    'size_id' => $size->id,
                ],
                [
                    'sku' => "S6NN95Z8-Q6K-{$name}",
                    'price' => 299.00,
                    'stock' => 20,
                    'is_active' => true,
                ],
            );
        }

        ProductImage::updateOrCreate(
            [
                'product_id' => $product->id,
                'color_id' => $color->id,
                'image' => 'products/men/xside-s6nn95z8-q6k-1.jpg',
            ],
            ['is_primary' => true, 'sort_order' => 1],
        );
    }
}
