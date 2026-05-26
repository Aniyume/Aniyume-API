<?php

namespace App\Application\Actions\Ai;

use App\Application\Services\Ai\AiChatSessionStore;
use App\Application\Services\Ai\AiGateway;
use App\Application\Services\Ai\AiPolicyGuard;
use App\Application\Services\Ai\AiPolicyResolver;
use App\Domain\Ai\AiChatRequestData;
use App\Domain\Ai\AiChatResponseData;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class SendAiChatMessageAction
{
    public function __construct(
        private readonly AiPolicyResolver $policyResolver,
        private readonly AiPolicyGuard $policyGuard,
        private readonly AiGateway $gateway,
        private readonly AiChatSessionStore $sessionStore,
    ) {}

    /**
     * @param  array<string, mixed>  $payload
     */
    public function execute(User $user, array $payload): AiChatResponseData
    {
        $policy = $this->policyResolver->resolveFor($user);
        $message = trim((string) $payload['message']);

        if (mb_strlen($message) > $policy->maxMessageLength) {
            throw ValidationException::withMessages([
                'message' => ['Message exceeds the allowed length for the current AI tier.'],
            ]);
        }

        $this->policyGuard->assertMessageAllowed(
            $policy,
            $message,
            is_array($payload['page_context'] ?? null) ? $payload['page_context'] : [],
        );

        [$session] = $this->sessionStore->findOrCreateFor($user, $payload['session_id'] ?? null, $policy);
        $this->sessionStore->recordUserMessage($session, $user, $message);

        $response = $this->gateway->chat(new AiChatRequestData(
            userId: (int) $user->id,
            message: $message,
            sessionId: $session->session_id,
            pageContext: $payload['page_context'] ?? [],
            policy: $policy,
        ));

        $this->sessionStore->recordAssistantMessage($session, $user, $response);

        return $response;
    }
}
