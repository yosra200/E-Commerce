<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Women
        |--------------------------------------------------------------------------
        */

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

        /*
        |--------------------------------------------------------------------------
        | Women > Clothing
        |--------------------------------------------------------------------------
        */

        $clothing = Category::create([
            'parent_id' => $women->id,
            'name' => [
                'en' => 'Clothing',
                'ar' => 'ملابس',
            ],
            'slug' => [
                'en' => 'clothing',
                'ar' => 'ملابس',
            ],
            'image' => null,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Tops
        |--------------------------------------------------------------------------
        */

        $tops = Category::create([
            'parent_id' => $clothing->id,
            'name' => [
                'en' => 'Tops',
                'ar' => 'ملابس علوية',
            ],
            'slug' => [
                'en' => 'tops',
                'ar' => 'ملابس-علوية',
            ],
            'image' => null,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Category::create([
            'parent_id' => $tops->id,
            'name' => [
                'en' => 'T-Shirts',
                'ar' => 'تي شيرت',
            ],
            'slug' => [
                'en' => 't-shirts',
                'ar' => 'تي-شيرت',
            ],
            'image' => null,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Category::create([
            'parent_id' => $tops->id,
            'name' => [
                'en' => 'Blouses',
                'ar' => 'بلوزات',
            ],
            'slug' => [
                'en' => 'blouses',
                'ar' => 'بلوزات',
            ],
            'image' => null,
            'is_active' => true,
            'sort_order' => 2,
        ]);

        Category::create([
            'parent_id' => $tops->id,
            'name' => [
                'en' => 'Shirts',
                'ar' => 'قمصان',
            ],
            'slug' => [
                'en' => 'shirts',
                'ar' => 'قمصان',
            ],
            'image' => null,
            'is_active' => true,
            'sort_order' => 3,
        ]);

        Category::create([
            'parent_id' => $tops->id,
            'name' => [
                'en' => 'Tunics',
                'ar' => 'تونيكات',
            ],
            'slug' => [
                'en' => 'tunics',
                'ar' => 'تونيكات',
            ],
            'image' => null,
            'is_active' => true,
            'sort_order' => 4,
        ]);

        Category::create([
            'parent_id' => $tops->id,
            'name' => [
                'en' => 'Crop Tops',
                'ar' => 'توب قصير',
            ],
            'slug' => [
                'en' => 'crop-tops',
                'ar' => 'توب-قصير',
            ],
            'image' => null,
            'is_active' => true,
            'sort_order' => 5,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Dresses
        |--------------------------------------------------------------------------
        */

        Category::create([
            'parent_id' => $clothing->id,
            'name' => [
                'en' => 'Dresses',
                'ar' => 'فساتين',
            ],
            'slug' => [
                'en' => 'dresses',
                'ar' => 'فساتين',
            ],
            'image' => null,
            'is_active' => true,
            'sort_order' => 2,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Jeans
        |--------------------------------------------------------------------------
        */

        Category::create([
            'parent_id' => $clothing->id,
            'name' => [
                'en' => 'Jeans',
                'ar' => 'جينز',
            ],
            'slug' => [
                'en' => 'jeans',
                'ar' => 'جينز',
            ],
            'image' => null,
            'is_active' => true,
            'sort_order' => 3,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Trousers
        |--------------------------------------------------------------------------
        */

        $trousers = Category::create([
            'parent_id' => $clothing->id,
            'name' => [
                'en' => 'Trousers',
                'ar' => 'بناطيل',
            ],
            'slug' => [
                'en' => 'trousers',
                'ar' => 'بناطيل',
            ],
            'image' => null,
            'is_active' => true,
            'sort_order' => 4,
        ]);

        Category::create([
            'parent_id' => $trousers->id,
            'name' => [
                'en' => 'Wide Leg',
                'ar' => 'واسع',
            ],
            'slug' => [
                'en' => 'wide-leg',
                'ar' => 'واسع',
            ],
            'image' => null,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Category::create([
            'parent_id' => $trousers->id,
            'name' => [
                'en' => 'Skinny',
                'ar' => 'سكيني',
            ],
            'slug' => [
                'en' => 'skinny',
                'ar' => 'سكيني',
            ],
            'image' => null,
            'is_active' => true,
            'sort_order' => 2,
        ]);

        Category::create([
            'parent_id' => $trousers->id,
            'name' => [
                'en' => 'Straight',
                'ar' => 'ستريت',
            ],
            'slug' => [
                'en' => 'straight',
                'ar' => 'ستريت',
            ],
            'image' => null,
            'is_active' => true,
            'sort_order' => 3,
        ]);

        /*
        |--------------------------------------------------------------------------
        | More Clothing
        |--------------------------------------------------------------------------
        */

        $moreClothing = [
            [
                'en' => 'Skirts',
                'ar' => 'جيبات',
                'slug_en' => 'skirts',
                'slug_ar' => 'جيبات',
            ],
            [
                'en' => 'Shorts',
                'ar' => 'شورتات',
                'slug_en' => 'shorts',
                'slug_ar' => 'شورتات',
            ],
            [
                'en' => 'Jackets & Coats',
                'ar' => 'جاكيتات ومعاطف',
                'slug_en' => 'jackets-coats',
                'slug_ar' => 'جاكيتات-ومعاطف',
            ],
            [
                'en' => 'Knitwear',
                'ar' => 'ملابس تريكو',
                'slug_en' => 'knitwear',
                'slug_ar' => 'ملابس-تريكو',
            ],
            [
                'en' => 'Sportswear',
                'ar' => 'ملابس رياضية',
                'slug_en' => 'sportswear',
                'slug_ar' => 'ملابس-رياضية',
            ],
            [
                'en' => 'Sleepwear',
                'ar' => 'ملابس نوم',
                'slug_en' => 'sleepwear',
                'slug_ar' => 'ملابس-نوم',
            ],
            [
                'en' => 'Underwear',
                'ar' => 'ملابس داخلية',
                'slug_en' => 'underwear',
                'slug_ar' => 'ملابس-داخلية',
            ],
            [
                'en' => 'Swimwear',
                'ar' => 'ملابس سباحة',
                'slug_en' => 'swimwear',
                'slug_ar' => 'ملابس-سباحة',
            ],
        ];

        foreach ($moreClothing as $index => $item) {
            Category::create([
                'parent_id' => $clothing->id,
                'name' => [
                    'en' => $item['en'],
                    'ar' => $item['ar'],
                ],
                'slug' => [
                    'en' => $item['slug_en'],
                    'ar' => $item['slug_ar'],
                ],
                'image' => null,
                'is_active' => true,
                'sort_order' => $index + 5,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Shoes
        |--------------------------------------------------------------------------
        */

        $shoes = Category::create([
            'parent_id' => $women->id,
            'name' => [
                'en' => 'Shoes',
                'ar' => 'أحذية',
            ],
            'slug' => [
                'en' => 'shoes',
                'ar' => 'أحذية',
            ],
            'image' => null,
            'is_active' => true,
            'sort_order' => 2,
        ]);

        $shoeCategories = [
            [
                'en' => 'Sneakers',
                'ar' => 'أحذية رياضية',
                'slug_en' => 'sneakers',
                'slug_ar' => 'أحذية-رياضية',
            ],
            [
                'en' => 'Flats',
                'ar' => 'أحذية فلات',
                'slug_en' => 'flats',
                'slug_ar' => 'أحذية-فلات',
            ],
            [
                'en' => 'Heels',
                'ar' => 'أحذية بكعب',
                'slug_en' => 'heels',
                'slug_ar' => 'أحذية-بكعب',
            ],
            [
                'en' => 'Sandals',
                'ar' => 'صنادل',
                'slug_en' => 'sandals',
                'slug_ar' => 'صنادل',
            ],
            [
                'en' => 'Boots',
                'ar' => 'بوت',
                'slug_en' => 'boots',
                'slug_ar' => 'بوت',
            ],
        ];

        foreach ($shoeCategories as $index => $item) {
            Category::create([
                'parent_id' => $shoes->id,
                'name' => [
                    'en' => $item['en'],
                    'ar' => $item['ar'],
                ],
                'slug' => [
                    'en' => $item['slug_en'],
                    'ar' => $item['slug_ar'],
                ],
                'image' => null,
                'is_active' => true,
                'sort_order' => $index + 1,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Bags
        |--------------------------------------------------------------------------
        */

        $bags = Category::create([
            'parent_id' => $women->id,
            'name' => [
                'en' => 'Bags',
                'ar' => 'شنط',
            ],
            'slug' => [
                'en' => 'bags',
                'ar' => 'شنط',
            ],
            'image' => null,
            'is_active' => true,
            'sort_order' => 3,
        ]);

        $bagCategories = [
            [
                'en' => 'Shoulder Bags',
                'ar' => 'شنط كتف',
                'slug_en' => 'shoulder-bags',
                'slug_ar' => 'شنط-كتف',
            ],
            [
                'en' => 'Handbags',
                'ar' => 'حقائب يد',
                'slug_en' => 'handbags',
                'slug_ar' => 'حقائب-يد',
            ],
            [
                'en' => 'Backpacks',
                'ar' => 'حقائب ظهر',
                'slug_en' => 'backpacks',
                'slug_ar' => 'حقائب-ظهر',
            ],
            [
                'en' => 'Beach Bags',
                'ar' => 'شنط شاطئ',
                'slug_en' => 'beach-bags',
                'slug_ar' => 'شنط-شاطئ',
            ],
        ];

        foreach ($bagCategories as $index => $item) {
            Category::create([
                'parent_id' => $bags->id,
                'name' => [
                    'en' => $item['en'],
                    'ar' => $item['ar'],
                ],
                'slug' => [
                    'en' => $item['slug_en'],
                    'ar' => $item['slug_ar'],
                ],
                'image' => null,
                'is_active' => true,
                'sort_order' => $index + 1,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Accessories
        |--------------------------------------------------------------------------
        */

        $accessories = Category::create([
            'parent_id' => $women->id,
            'name' => [
                'en' => 'Accessories',
                'ar' => 'إكسسوارات',
            ],
            'slug' => [
                'en' => 'accessories',
                'ar' => 'إكسسوارات',
            ],
            'image' => null,
            'is_active' => true,
            'sort_order' => 4,
        ]);

        $accessoryCategories = [
            [
                'en' => 'Belts',
                'ar' => 'أحزمة',
                'slug_en' => 'belts',
                'slug_ar' => 'أحزمة',
            ],
            [
                'en' => 'Hats',
                'ar' => 'قبعات',
                'slug_en' => 'hats',
                'slug_ar' => 'قبعات',
            ],
            [
                'en' => 'Hair Accessories',
                'ar' => 'إكسسوارات شعر',
                'slug_en' => 'hair-accessories',
                'slug_ar' => 'إكسسوارات-شعر',
            ],
            [
                'en' => 'Socks',
                'ar' => 'جوارب',
                'slug_en' => 'socks',
                'slug_ar' => 'جوارب',
            ],
        ];

        foreach ($accessoryCategories as $index => $item) {
            Category::create([
                'parent_id' => $accessories->id,
                'name' => [
                    'en' => $item['en'],
                    'ar' => $item['ar'],
                ],
                'slug' => [
                    'en' => $item['slug_en'],
                    'ar' => $item['slug_ar'],
                ],
                'image' => null,
                'is_active' => true,
                'sort_order' => $index + 1,
            ]);
        }
    }
}
