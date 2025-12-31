<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWatchHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'episode_id' => 'required|exists:episodes,id',
            'progress' => 'required|integer|min:0',
            'completed' => 'sometimes|boolean',
        ];
    }
}
