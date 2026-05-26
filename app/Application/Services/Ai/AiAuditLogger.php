<?php

namespace App\Application\Services\Ai;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class AiAuditLogger
{
    public function __construct(private readonly AiAuditContextSanitizer $sanitizer)
    {
    }

    /**
     * @param  array<string, mixed>  $context
     */
    public function record(Request $request, User $user, string $role, string $endpoint, ?string $tool, string $result, array $context = []): void
    {
        try {
            AuditLog::create([
                'user_id' => $user->id,
                'action' => $tool ? 'ai_tool' : 'ai_chat',
                'description' => json_encode([
                    'role' => $role,
                    'endpoint' => $endpoint,
                    'tool' => $tool,
                    'result' => $result,
                    'context' => $this->sanitizer->sanitize($context),
                ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                'ip_address' => $request->ip(),
                'user_agent' => substr((string) $request->userAgent(), 0, 1024),
                'created_at' => now(),
            ]);
        } catch (Throwable) {
            // Audit logging must never expose internals to the AI endpoint caller.
        }
    }

}
