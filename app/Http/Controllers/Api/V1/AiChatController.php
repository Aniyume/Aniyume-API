<?php

namespace App\Http\Controllers\Api\V1;

use App\Application\Services\Ai\AiAuditLogger;
use App\Application\Services\Ai\AiRoleResolver;
use App\Application\Actions\Ai\SendAiChatMessageAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\AiChatRequest;
use Illuminate\Http\JsonResponse;
use Throwable;

class AiChatController extends Controller
{
    public function __construct(
        private readonly SendAiChatMessageAction $sendAiChatMessage,
        private readonly AiRoleResolver $roleResolver,
        private readonly AiAuditLogger $auditLogger,
    ) {
    }

    public function __invoke(AiChatRequest $request): JsonResponse
    {
        $user = $request->user();
        $role = $this->roleResolver->resolve($user);
        $endpoint = 'POST /api/v1/ai/chat';

        try {
            $response = $this->sendAiChatMessage->execute($user, $request->validated());

                $this->auditLogger->record($request, $user, $role, $endpoint, null, 'success', [
                    'session_id_present' => $request->filled('session_id'),
                    'page_context' => $request->input('page_context', []),
                ]);

            return response()->json([
                'status' => 'success',
                'data' => $response->toArray(),
            ]);
        } catch (Throwable $exception) {
            $this->auditLogger->record($request, $user, $role, $endpoint, null, 'error', [
                'error' => class_basename($exception),
            ]);

            throw $exception;
        }
    }
}
