<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'social_facebook' => 'رابط صفحتنا على فيسبوك',
            'social_instagram' => 'رابط صفحتنا على إنستاجرام',
            'social_twitter' => 'رابط صفحتنا على تويتر',
            'terms_and_conditions' => 'شروط وأحكام افتراضية. حرّر هذا النص من لوحة التحكم.',
            'privacy_policy' => 'سياسة خصوصية افتراضية. حرّر هذا النص من لوحة التحكم.',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate([
                'key' => $key,
            ], [
                'value' => $value,
            ]);
        }
    }
}
