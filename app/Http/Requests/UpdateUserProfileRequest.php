<?php

namespace App\Http\Requests;

use App\Domain\Moderation\ModerationMode;
use App\Http\Rules\PassesModeration;
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
            'name' => ['sometimes', 'string', 'max:255', new PassesModeration(ModerationMode::Soft)],
            'bio' => ['nullable', 'string', 'max:500', new PassesModeration(ModerationMode::Medium)],
            'custom_status' => ['nullable', 'string', 'max:100', new PassesModeration(ModerationMode::Medium)],
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
