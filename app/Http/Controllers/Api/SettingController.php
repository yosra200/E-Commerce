<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\ApiResponse;

class SettingController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $settings = Setting::query()
            ->whereIn('key', ['about_us', 'privacy_policy', 'social_media'])
            ->get()
            ->mapWithKeys(fn (Setting $setting) => [$setting->key => $setting->value]);

        return $this->successResponse([
            'about_us' => $settings->get('about_us'),
            'privacy_policy' => $settings->get('privacy_policy'),
            'social_media' => $settings->get('social_media', []),
        ], __('messages.settings_retrieved_successfully'));
    }
}
