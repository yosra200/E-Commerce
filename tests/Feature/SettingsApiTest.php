<?php

namespace Tests\Feature;

use App\Models\Setting;
use Tests\TestCase;

class SettingsApiTest extends TestCase
{
    public function test_settings_api_returns_terms_and_conditions_and_social_media(): void
    {
        Setting::query()->create([
            'key' => 'about_us',
            'value' => ['ar' => 'من نحن بالعربية', 'en' => 'About us in English'],
        ]);

        Setting::query()->create([
            'key' => 'privacy_policy',
            'value' => ['ar' => 'سياسة الخصوصية بالعربية', 'en' => 'Privacy policy in English'],
        ]);

        Setting::query()->create([
            'key' => 'terms_and_conditions',
            'value' => ['ar' => 'الشروط بالعربية', 'en' => 'Terms in English'],
        ]);

        Setting::query()->create([
            'key' => 'social_media',
            'value' => [
                'facebook' => 'https://facebook.com',
                'instagram' => 'https://instagram.com',
                'whatsapp' => 'https://wa.me/966500000000',
            ],
        ]);

        $response = $this->getJson('/api/settings');

        $response->assertOk()
            ->assertJsonPath('data.about_us.ar', 'من نحن بالعربية')
            ->assertJsonPath('data.privacy_policy.ar', 'سياسة الخصوصية بالعربية')
            ->assertJsonPath('data.terms_and_conditions.ar', 'الشروط بالعربية')
            ->assertJsonPath('data.social_media.facebook', 'https://facebook.com');
    }

    
}
