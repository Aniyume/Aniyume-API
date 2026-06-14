<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\Moderation\ModerationMode;
use App\Http\Controllers\Controller;
use App\Http\Rules\PassesAiModeration;
use App\Http\Rules\PassesModeration;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactMessageController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:120', new PassesModeration(ModerationMode::Soft), new PassesAiModeration('contact_name')],
            'email' => ['nullable', 'email', 'max:255'],
            'category' => ['required', 'string', Rule::in(['bug', 'idea', 'feedback', 'content', 'account', 'other'])],
            'subject' => ['required', 'string', 'max:180', new PassesModeration(ModerationMode::Medium), new PassesAiModeration('contact_subject')],
            'message' => ['required', 'string', 'min:10', 'max:5000', new PassesModeration(ModerationMode::Medium), new PassesAiModeration('contact_message')],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:4096'],
        ]);

        $recentDuplicate = ContactMessage::query()
            ->where('ip_address', $request->ip())
            ->where('subject', $validated['subject'])
            ->where('created_at', '>=', now()->subMinutes(10))
            ->exists();

        if ($recentDuplicate) {
            return response()->json(['message' => 'Похожее сообщение уже отправлено недавно.'], 429);
        }

        $message = ContactMessage::create([
            ...$validated,
            ...$this->photoPayload($request),
            'user_id' => $request->user()?->id,
            'status' => ContactMessage::STATUS_NEW,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json([
            'message' => 'Сообщение отправлено. Спасибо за обратную связь!',
            'data' => ['id' => $message->id, 'status' => $message->status],
        ], 201);
    }

    private function photoPayload(Request $request): array
    {
        if (! $request->hasFile('photo')) {
            return [];
        }

        $file = $request->file('photo');

        return [
            'photo' => file_get_contents($file->getRealPath()),
            'photo_mime' => $file->getMimeType(),
            'photo_name' => $file->getClientOriginalName(),
            'photo_size' => $file->getSize(),
        ];
    }
}
