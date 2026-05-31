<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Comment;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReportController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'target_type' => ['required', 'string', Rule::in(['anime', 'comment', 'user'])],
            'target_id' => ['required', 'integer', 'min:1'],
            'category' => ['required', 'string', Rule::in(['spam', 'abuse', 'toxicity', 'bug', 'content', 'copyright', 'other'])],
            'reason' => ['required', 'string', 'max:255'],
            'details' => ['nullable', 'string', 'max:3000'],
        ]);

        $targetClass = match ($validated['target_type']) {
            'anime' => Anime::class,
            'comment' => Comment::class,
            'user' => User::class,
        };

        $target = $targetClass::query()->findOrFail($validated['target_id']);
        if ($target instanceof User && $request->user()?->id === $target->id) {
            return response()->json(['message' => 'Нельзя отправить жалобу на самого себя.'], 422);
        }

        $duplicate = Report::query()
            ->where('target_type', $targetClass)
            ->where('target_id', $target->getKey())
            ->where(function ($query) use ($request) {
                $query->where('reporter_id', $request->user()?->id)
                    ->orWhere(function ($query) {
                        $query->whereNull('reporter_id')->where('created_at', '>=', now()->subMinutes(30));
                    });
            })
            ->where('created_at', '>=', now()->subMinutes(30))
            ->exists();

        if ($duplicate) {
            return response()->json(['message' => 'Похожая жалоба уже отправлена недавно.'], 429);
        }

        $report = Report::create([
            'reporter_id' => $request->user()?->id,
            'target_type' => $targetClass,
            'target_id' => $target->getKey(),
            'category' => $validated['category'],
            'reason' => $validated['reason'],
            'details' => $validated['details'] ?? null,
            'status' => Report::STATUS_PENDING,
        ]);

        return response()->json([
            'message' => 'Жалоба отправлена. Спасибо, мы проверим.',
            'data' => ['id' => $report->id, 'status' => $report->status],
        ], 201);
    }
}
