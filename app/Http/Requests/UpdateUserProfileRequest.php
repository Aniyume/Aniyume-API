<?php

namespace App\Http\Requests;

use App\Domain\Moderation\ModerationMode;
use App\Http\Rules\PassesAiModeration;
use App\Http\Rules\PassesModeration;
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
        $nameRules = ['sometimes', 'string', 'max:255', Rule::unique('users', 'name')->ignore($this->user()?->id)];
        if ($this->input('name') !== $this->user()?->name) {
            $nameRules[] = function (string $attribute, mixed $value, \Closure $fail): void {
                $exists = \App\Models\User::query()
                    ->whereKeyNot($this->user()?->id)
                    ->whereRaw('LOWER(name) = ?', [mb_strtolower(trim((string) $value))])
                    ->exists();
                if ($exists) {
                    $fail('Это имя уже занято другим пользователем');
                }
            };
            $nameRules[] = new PassesModeration(ModerationMode::Soft);
            $nameRules[] = new PassesAiModeration('profile_name');
        }

        $statusRules = ['nullable', 'string', 'max:100'];
        if ($this->input('custom_status') !== $this->user()?->custom_status) {
            $statusRules[] = new PassesModeration(ModerationMode::Medium);
            $statusRules[] = new PassesAiModeration('profile_status');
        }

        return [
            'name' => $nameRules,
            'custom_status' => $statusRules,
            'social_links' => ['sometimes', 'array', 'max:10'],
            'social_links.*' => ['required', 'url:http,https', 'max:500'],
            'theme_value' => ['sometimes', 'nullable', 'string', 'max:255'],
            'theme_type' => ['sometimes', 'nullable', 'in:gradient,solid'],
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
