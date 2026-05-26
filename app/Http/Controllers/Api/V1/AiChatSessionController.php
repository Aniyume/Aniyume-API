<?php

namespace App\Http\Controllers\Api\V1;

use App\Application\Services\Ai\AiChatSessionStore;
use App\Http\Controllers\Controller;
use App\Models\AiChatSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AiChatSessionController extends Controller
{
    public function __construct(
        private readonly AiChatSessionStore $sessionStore,
    ) {
    }

    public function index(Request $request): JsonResponse
    {
        $sessions = AiChatSession::query()
            ->where('user_id', $request->user()->id)
            ->withCount('messages')
            ->latest('last_message_at')
            ->latest('id')
            ->limit(50)
            ->get()
            ->map(fn (AiChatSession $session): array => $this->serializeSessionSummary($session))
            ->values();

        return response()->json([
            'status' => 'success',
            'data' => [
                'sessions' => $sessions,
            ],
        ]);
    }

    public function show(Request $request, string $sessionId): JsonResponse
    {
        /** @var AiChatSession|null $session */
        $session = AiChatSession::query()
            ->where('session_id', $sessionId)
            ->where('user_id', $request->user()->id)
            ->first();

        abort_if($session === null, 404);

        return response()->json([
            'status' => 'success',
            'data' => [
                'session_id' => $session->session_id,
                'created_at' => $session->created_at?->toIso8601String(),
                'updated_at' => $session->updated_at?->toIso8601String(),
                'last_message_at' => $session->last_message_at?->toIso8601String(),
                'messages' => $this->sessionStore->recentHistory($session),
            ],
        ]);
    }

    private function serializeSessionSummary(AiChatSession $session): array
    {
        return [
            'session_id' => $session->session_id,
            'created_at' => $session->created_at?->toIso8601String(),
            'updated_at' => $session->updated_at?->toIso8601String(),
            'last_message_at' => $session->last_message_at?->toIso8601String(),
            'messages_count' => $session->messages_count,
        ];
    }
}
