<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRatingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'anime_id' => 'required|integer|exists:anime,id',
            'rating' => 'required|numeric|min:1|max:10',
        ];
    }
}
