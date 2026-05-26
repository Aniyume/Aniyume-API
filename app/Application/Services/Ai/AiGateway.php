<?php

namespace App\Application\Services\Ai;

use App\Domain\Ai\AiChatRequestData;
use App\Domain\Ai\AiChatResponseData;

interface AiGateway
{
    public function chat(AiChatRequestData $request): AiChatResponseData;
}
