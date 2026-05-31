<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactMessageController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:120'],
            'email' => ['nullable', 'email', 'max:255'],
            'category' => ['required', 'string', Rule::in(['bug', 'idea', 'feedback', 'content', 'account', 'other'])],
            'subject' => ['required', 'string', 'max:180'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
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
}
