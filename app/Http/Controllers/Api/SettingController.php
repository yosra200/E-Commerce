<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\ApiResponse;
use App\Http\Resources\SettingsResource;

class SettingController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $settings = Setting::query()
            ->whereIn('key', [
                'terms_and_conditions',
                'privacy_policy',
                'social_facebook',
                'social_instagram',
                'social_twitter',
                'about_us',
            ])
            ->get()
            ->mapWithKeys(fn (Setting $setting) => [$setting->key => $setting->value])
            ->toArray();

        $resource = new SettingsResource($settings);

        return $this->successResponse($resource->toArray(request()), __('messages.settings_retrieved_successfully'));
    }

    public function social()
    {
        $settings = Setting::query()
            ->whereIn('key', [
                'social_facebook',
                'social_instagram',
                'social_twitter',
            ])
            ->get()
            ->mapWithKeys(fn (Setting $setting) => [$setting->key => $setting->value]);

        $data = [
            'facebook' => $settings->get('social_facebook'),
            'instagram' => $settings->get('social_instagram'),
            'twitter' => $settings->get('social_twitter'),
        ];

        return $this->successResponse($data, __('messages.settings_retrieved_successfully'));
    }

    public function privacy()
    {
        $setting = Setting::where('key', 'privacy_policy')->first();

        return $this->successResponse([
            'privacy_policy' => $setting?->value,
        ], __('messages.settings_retrieved_successfully'));
    }

    public function terms()
    {
        $setting = Setting::where('key', 'terms_and_conditions')->first();

        return $this->successResponse([
            'terms_and_conditions' => $setting?->value,
        ], __('messages.settings_retrieved_successfully'));
    }
}
