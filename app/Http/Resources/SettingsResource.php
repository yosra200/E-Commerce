<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        $data = $this->resource;

        return [
            'terms_and_conditions' => $data['terms_and_conditions'] ?? $data['about_us'] ?? null,
            'privacy_policy' => $data['privacy_policy'] ?? null,
            'social_media' => [
                'facebook' => $data['social_facebook'] ?? null,
                'instagram' => $data['social_instagram'] ?? null,
                'twitter' => $data['social_twitter'] ?? null,
            ],
        ];
    }
}
