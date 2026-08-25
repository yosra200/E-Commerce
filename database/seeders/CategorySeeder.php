<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::query()->delete();

        $categories = [
            [
                'name' => [
                    'ar' => 'كاميرات مراقبة',
                    'en' => 'Surveillance Cameras',
                ],
                'slug' => [
                    'ar' => 'كاميرات-مراقبة',
                    'en' => 'surveillance-cameras',
                ],
                'sort_order' => 1,
            ],

            [
                'name' => [
                    'ar' => 'بصمة وحضور',
                    'en' => 'Attendance & Fingerprint',
                ],
                'slug' => [
                    'ar' => 'بصمة-وحضور',
                    'en' => 'attendance-fingerprint',
                ],
                'sort_order' => 2,
            ],

            [
                'name' => [
                    'ar' => 'أنظمة أمن',
                    'en' => 'Security Systems',
                ],
                'slug' => [
                    'ar' => 'أنظمة-أمن',
                    'en' => 'security-systems',
                ],
                'sort_order' => 3,
            ],

            [
                'name' => [
                    'ar' => 'شاشات',
                    'en' => 'Monitors',
                ],
                'slug' => [
                    'ar' => 'شاشات',
                    'en' => 'monitors',
                ],
                'sort_order' => 4,
            ],

            [
                'name' => [
                    'ar' => 'الطباعات والكاشيرات',
                    'en' => 'Printers & POS',
                ],
                'slug' => [
                    'ar' => 'الطباعات-والكاشيرات',
                    'en' => 'printers-pos',
                ],
                'sort_order' => 5,
            ],

            [
                'name' => [
                    'ar' => 'لابتات وكمبيوترات',
                    'en' => 'Laptops & Computers',
                ],
                'slug' => [
                    'ar' => 'لابتات-وكمبيوترات',
                    'en' => 'laptops-computers',
                ],
                'sort_order' => 6,
            ],

            [
                'name' => [
                    'ar' => 'ماوس وكيبورد',
                    'en' => 'Mouse & Keyboard',
                ],
                'slug' => [
                    'ar' => 'ماوس-وكيبورد',
                    'en' => 'mouse-keyboard',
                ],
                'sort_order' => 7,
            ],

            [
                'name' => [
                    'ar' => 'كيبلات وملحقات',
                    'en' => 'Cables & Accessories',
                ],
                'slug' => [
                    'ar' => 'كيبلات-وملحقات',
                    'en' => 'cables-accessories',
                ],
                'sort_order' => 8,
            ],

            [
                'name' => [
                    'ar' => 'تحكم وأبواب',
                    'en' => 'Access Control & Doors',
                ],
                'slug' => [
                    'ar' => 'تحكم-وأبواب',
                    'en' => 'access-control-doors',
                ],
                'sort_order' => 9,
            ],

            // الاسم الأخير في الصورة غير ظاهر بالكامل
            [
                'name' => [
                    'ar' => ' مستلزمات',
                    'en' => 'Supplies',
                ],
                'slug' => [
                    'ar' => 'مستلزمات',
                    'en' => 'supplies',
                ],
                'sort_order' => 10,
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'image' => null,
                'is_active' => true,
                'sort_order' => $category['sort_order'],
            ]);
        }
    }
}
