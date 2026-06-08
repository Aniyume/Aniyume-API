<?php

namespace App\Http\Requests;

use App\Domain\Moderation\ModerationMode;
use App\Http\Rules\PassesModeration;
use App\Http\Rules\PassesAiModeration;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('users', 'name')->ignore($this->user()?->id), new PassesModeration(ModerationMode::Soft), new PassesAiModeration('profile_name')],
            'custom_status' => ['nullable', 'string', 'max:100', new PassesModeration(ModerationMode::Medium), new PassesAiModeration('profile_status')],
        ];
    }

    public function messages(): array
    {
        return [
            'name.max' => 'Name cannot exceed 255 characters',
            'name.unique' => 'Это имя уже занято другим пользователем',
            'custom_status.max' => 'Custom status cannot exceed 100 characters',
        ];
    }
}
