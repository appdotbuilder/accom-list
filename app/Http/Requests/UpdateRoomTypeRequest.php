<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomTypeRequest extends FormRequest
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
            'description' => 'nullable|string',
            'price_per_night' => 'required|numeric|min:0',
            'max_occupancy' => 'required|integer|min:1',
            'size_sqm' => 'nullable|integer|min:1',
            'amenities' => 'nullable|array',
            'image' => 'nullable|string',
            'is_available' => 'boolean',
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
            'name.required' => 'Room type name is required.',
            'price_per_night.required' => 'Price per night is required.',
            'price_per_night.min' => 'Price must be greater than or equal to 0.',
            'max_occupancy.required' => 'Maximum occupancy is required.',
            'max_occupancy.min' => 'Maximum occupancy must be at least 1.',
            'size_sqm.min' => 'Size must be at least 1 square meter.',
        ];
    }
}