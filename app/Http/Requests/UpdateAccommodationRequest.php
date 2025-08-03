<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccommodationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|in:hotel,inn,house',
            'description' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'price_from' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
            'featured_image' => 'nullable|string',
            'gallery' => 'nullable|array',
            'facilities' => 'nullable|array',
            'facilities.*' => 'exists:facilities,id',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Accommodation name is required.',
            'type.required' => 'Accommodation type is required.',
            'type.in' => 'Accommodation type must be hotel, inn, or house.',
            'description.required' => 'Description is required.',
            'address.required' => 'Address is required.',
            'latitude.between' => 'Latitude must be between -90 and 90.',
            'longitude.between' => 'Longitude must be between -180 and 180.',
            'email.email' => 'Please provide a valid email address.',
            'website.url' => 'Please provide a valid website URL.',
            'price_from.min' => 'Price must be greater than or equal to 0.',
        ];
    }
}