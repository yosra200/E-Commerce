<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'regex:/^01[0125][0-9]{8}$/',
                'unique:users,phone',
            ],

            'category_id' => [
                'required',
                'integer',
                'exists:categories,id',
            ],

            'location_details' => [
                'nullable',
                'string',
            ],

            'latitude' => [
                'nullable',
                'numeric',
                'between:-90,90',
            ],

            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180',
            ],

            'google_maps_url' => [
                'nullable',
                'url',
                'max:2000',
            ],

            'images' => [
                'nullable',
                'array',
                'max:10',
            ],

            'images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'الاسم مطلوب',

            'phone.required' => 'رقم الهاتف مطلوب',

            'service_type.required' => 'نوع الخدمة مطلوب',

            'latitude.numeric' => 'خط العرض يجب أن يكون رقمًا',
            'latitude.between' => 'خط العرض يجب أن يكون بين -90 و 90',

            'longitude.numeric' => 'خط الطول يجب أن يكون رقمًا',
            'longitude.between' => 'خط الطول يجب أن يكون بين -180 و 180',

            'google_maps_url.url' => 'رابط Google Maps غير صحيح',

            'images.array' => 'الصور يجب أن تكون مصفوفة',

            'images.max' => 'يمكن رفع 10 صور كحد أقصى',

            'images.*.image' => 'الملف يجب أن يكون صورة',
            'images.*.mimes' => 'الصورة يجب أن تكون jpg أو jpeg أو png أو webp',
            'images.*.max' => 'حجم الصورة يجب ألا يتجاوز 5 ميجابايت',
        ];
    }
}
