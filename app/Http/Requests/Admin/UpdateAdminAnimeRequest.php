<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminAnimeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string'],
            'poster_url' => ['sometimes', 'nullable', 'url', 'max:1024'],
            'rating' => ['sometimes', 'nullable', 'numeric', 'between:0,10'],
            'year' => ['sometimes', 'nullable', 'integer', 'between:1900,2100'],
            'status' => ['sometimes', 'required', 'string', Rule::in(['planned', 'ongoing', 'finished', 'paused'])],
            'type' => ['sometimes', 'required', 'string', Rule::in(['tv', 'movie', 'ova', 'ona', 'special', 'music'])],
            'number_of_episodes' => ['sometimes', 'nullable', 'integer', 'min:0'],
            'nsfw_flag' => ['sometimes', 'boolean'],
            'tags' => ['sometimes', 'array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ];
    }
}
