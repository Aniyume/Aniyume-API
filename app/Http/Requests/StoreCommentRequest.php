<?php

namespace App\Http\Requests;

use App\Domain\Moderation\ModerationMode;
use App\Http\Rules\PassesModeration;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'anime_id' => 'required|integer|exists:anime,id',
            'comment' => ['required', 'string', 'min:3', 'max:1000', new PassesModeration(ModerationMode::Medium)],
        ];
    }
}
