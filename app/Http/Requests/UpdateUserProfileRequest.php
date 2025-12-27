<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'bio' => 'nullable|string|max:500',
            'custom_status' => 'nullable|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'name.max' => 'Name cannot exceed 255 characters',
            'bio.max' => 'Bio cannot exceed 500 characters',
            'custom_status.max' => 'Custom status cannot exceed 100 characters',
        ];
    }
}
