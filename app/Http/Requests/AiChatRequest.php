<?php

namespace App\Http\Requests;

use App\Domain\Moderation\ModerationMode;
use App\Http\Rules\PassesModeration;
use Illuminate\Foundation\Http\FormRequest;

class AiChatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'message' => ['required', 'string', 'max:4000', new PassesModeration(ModerationMode::Strict)],
            'session_id' => ['nullable', 'string', 'max:120'],
            'page_context' => ['nullable', 'array'],
            'page_context.route' => ['nullable', 'string', 'max:120'],
            'page_context.anime_id' => ['nullable', 'integer'],
            'page_context.episode_id' => ['nullable', 'integer'],
            'page_context.title' => ['nullable', 'string', 'max:255'],
            'page_context.locale' => ['nullable', 'string', 'max:10'],
            'messages' => ['prohibited'],
            'conversation' => ['prohibited'],
        ];
    }
}
