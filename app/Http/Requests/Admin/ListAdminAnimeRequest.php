<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListAdminAnimeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page' => ['sometimes', 'integer', 'min:1'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
            'search' => ['sometimes', 'string', 'max:255'],
            'status' => ['sometimes', 'string', Rule::in(['planned', 'ongoing', 'finished', 'paused'])],
            'type' => ['sometimes', 'string', Rule::in(['tv', 'movie', 'ova', 'ona', 'special', 'music'])],
            'tag_id' => ['sometimes', 'integer', 'exists:tags,id'],
            'nsfw_flag' => ['sometimes', 'boolean'],
            'sort' => ['sometimes', 'string', Rule::in(['created_at', 'updated_at', 'title', 'rating', 'year', 'episodes_count'])],
            'direction' => ['sometimes', 'string', Rule::in(['asc', 'desc'])],
        ];
    }
}
