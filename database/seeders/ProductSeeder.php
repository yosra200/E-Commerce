<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Get Women Category
        |--------------------------------------------------------------------------
        */

        $women = Category::where('slug->en', 'women')->first();

        if (!$women) {
            $women = Category::create([
                'name' => [
                    'en' => 'Women',
                    'ar' => 'نساء',
                ],
                'slug' => [
                    'en' => 'women',
                    'ar' => 'نساء',
                ],
                'image' => null,
                'is_active' => true,
                'sort_order' => 1,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Colors
        |--------------------------------------------------------------------------
        */

        $blue = Color::firstOrCreate(
            [
                'code' => '#ADD8E6',
            ],
            [
                'name' => [
                    'en' => 'Blue',
                    'ar' => 'أزرق',
                ],
                'image' => null,
            ]
        );

        $white = Color::firstOrCreate(
            [
                'code' => '#FFFFFF',
            ],
            [
                'name' => [
                    'en' => 'White',
                    'ar' => 'أبيض',
                ],
                'image' => null,
            ]
        );

        $red = Color::firstOrCreate(
            [
                'code' => '#FF0000',
            ],
            [
                'name' => [
                    'en' => 'Red',
                    'ar' => 'أحمر',
                ],
                'image' => null,
            ]
        );

        $yellow = Color::firstOrCreate(
            [
                'code' => '#FFD700',
            ],
            [
                'name' => [
                    'en' => 'Yellow',
                    'ar' => 'أصفر',
                ],
                'image' => null,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Sizes
        |--------------------------------------------------------------------------
        */

        $sizes = [];

        $sizeData = [
            [
                'en' => 'XS',
                'ar' => 'XS',
                'sort_order' => 1,
            ],
            [
                'en' => 'S',
                'ar' => 'S',
                'sort_order' => 2,
            ],
            [
                'en' => 'M',
                'ar' => 'M',
                'sort_order' => 3,
            ],
            [
                'en' => 'L',
                'ar' => 'L',
                'sort_order' => 4,
            ],
            [
                'en' => 'XL',
                'ar' => 'XL',
                'sort_order' => 5,
            ],
        ];

        foreach ($sizeData as $data) {
            $size = Size::where('name->en', $data['en'])->first();

            if (!$size) {
                $size = Size::create([
                    'name' => [
                        'en' => $data['en'],
                        'ar' => $data['ar'],
                    ],
                    'sort_order' => $data['sort_order'],
                ]);
            }

            $sizes[$data['en']] = $size;
        }

        /*
        |--------------------------------------------------------------------------
        | Product
        |--------------------------------------------------------------------------
        */

        $product = Product::updateOrCreate(
            [
                'sku' => 'WOMEN-TOP-001',
            ],
            [
                'category_id' => $women->id,

                'name' => [
                    'en' => 'Sleeveless Crew Neck Top',
                    'ar' => 'توب بدون أكمام بياقة دائرية',
                ],

                'description' => [
                    'en' => 'Comfortable sleeveless crew neck top for women.',
                    'ar' => 'توب مريح بدون أكمام بياقة دائرية للنساء.',
                ],

                'price' => 349,
                'compare_price' => 449,

                'is_active' => true,

                'sort_order' => 1,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Product Variants
        |--------------------------------------------------------------------------
        */

        $colors = [
            $blue,
            $white,
            $red,
            $yellow,
        ];

        foreach ($colors as $color) {

            foreach ($sizes as $sizeName => $size) {

                $stock = match ($sizeName) {
                    'XS' => 10,
                    'S' => 15,
                    'M' => 20,
                    'L' => 12,
                    'XL' => 0,
                    default => 0,
                };

                $variantSku =
                    'WOMEN-TOP-001-' .
                    strtoupper($sizeName) .
                    '-' .
                    $color->id;

                ProductVariant::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'color_id' => $color->id,
                        'size_id' => $size->id,
                    ],
                    [
                        'sku' => $variantSku,
                        'price' => 349,
                        'stock' => $stock,
                        'is_active' => true,
                    ]
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Product Images
        |--------------------------------------------------------------------------
        */

        $images = [

            // Blue
            [
                'color_id' => $blue->id,
                'image' => 'products/women/top-blue-1.jpg',
                'is_primary' => true,
                'sort_order' => 1,
            ],
            [
                'color_id' => $blue->id,
                'image' => 'products/women/top-blue-2.jpg',
                'is_primary' => false,
                'sort_order' => 2,
            ],

            // White
            [
                'color_id' => $white->id,
                'image' => 'products/women/top-white-1.jpg',
                'is_primary' => true,
                'sort_order' => 1,
            ],
            [
                'color_id' => $white->id,
                'image' => 'products/women/top-white-2.jpg',
                'is_primary' => false,
                'sort_order' => 2,
            ],

            // Red
            [
                'color_id' => $red->id,
                'image' => 'products/women/top-red-1.jpg',
                'is_primary' => true,
                'sort_order' => 1,
            ],

            // Yellow
            [
                'color_id' => $yellow->id,
                'image' => 'products/women/top-yellow-1.jpg',
                'is_primary' => true,
                'sort_order' => 1,
            ],
        ];

        foreach ($images as $image) {

            ProductImage::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'color_id' => $image['color_id'],
                    'image' => $image['image'],
                ],
                [
                    'is_primary' => $image['is_primary'],
                    'sort_order' => $image['sort_order'],
                ]
            );
        }
    }
}
