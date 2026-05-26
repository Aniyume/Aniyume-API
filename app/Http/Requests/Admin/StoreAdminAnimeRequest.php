<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAdminAnimeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'poster_url' => ['nullable', 'url', 'max:1024'],
            'rating' => ['nullable', 'numeric', 'between:0,10'],
            'year' => ['nullable', 'integer', 'between:1900,2100'],
            'status' => ['required', 'string', Rule::in(['planned', 'ongoing', 'finished', 'paused'])],
            'type' => ['required', 'string', Rule::in(['tv', 'movie', 'ova', 'ona', 'special', 'music'])],
            'number_of_episodes' => ['nullable', 'integer', 'min:0'],
            'nsfw_flag' => ['sometimes', 'boolean'],
            'tags' => ['sometimes', 'array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ];
    }
}
