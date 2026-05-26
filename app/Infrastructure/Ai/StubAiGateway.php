<?php

namespace App\Infrastructure\Ai;

use App\Application\Services\Ai\AiContextBuilder;
use App\Application\Services\Ai\AiGateway;
use App\Domain\Ai\AiChatRequestData;
use App\Domain\Ai\AiChatResponseData;
use Illuminate\Support\Str;

class StubAiGateway implements AiGateway
{
    public function __construct(private readonly AiContextBuilder $contextBuilder) {}

    public function chat(AiChatRequestData $request): AiChatResponseData
    {
        $context = $this->contextBuilder->build($request->pageContext, $request->policy);
        $sessionId = $request->sessionId ?: (string) Str::uuid();

        return new AiChatResponseData(
            message: 'AI gateway is ready. External LLM provider is not configured yet, so this safe stub response was returned.',
            sessionId: $sessionId,
            provider: 'stub',
            moderated: false,
            metadata: [
                'tier' => $request->policy->tier,
                'context_keys' => array_keys($context['page']),
                'next_layers_ready' => ['role_policy', 'moderation', 'provider_adapter'],
            ],
        );
    }
}
