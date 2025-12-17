<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWatchHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'anime_id' => 'required|integer|exists:anime,id',
            'episode_id' => 'required|integer|exists:episodes,id',
            'progress' => 'nullable|integer|min:0',
            'completed' => 'nullable|boolean',
        ];
    }
}
