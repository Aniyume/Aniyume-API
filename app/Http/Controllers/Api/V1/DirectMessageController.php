<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\Moderation\ModerationMode;
use App\Http\Controllers\Controller;
use App\Http\Rules\PassesAiModeration;
use App\Http\Rules\PassesModeration;
use App\Models\DirectMessage;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DirectMessageController extends Controller
{
    public function conversations(Request $request): JsonResponse
    {
        $user = $request->user();
        $friendIds = $this->friendIds($user->id);
        $friends = User::query()
            ->whereIn('id', $friendIds)
            ->select('id', 'name', 'avatar', 'custom_status', 'is_online', 'selected_profile_frame')
            ->get();

        $data = $friends->map(function (User $friend) use ($user) {
            $last = $this->messagesBetween($user->id, $friend->id)->latest()->first();

            return [
                'user' => $this->formatUser($friend, $user->id),
                'last_message' => $last ? $this->formatMessage($last) : null,
            ];
        })->sortByDesc(fn (array $chat) => $chat['last_message']['created_at'] ?? '')->values();

        return response()->json(['data' => $data]);
    }

    public function show(Request $request, int $userId): JsonResponse
    {
        $user = $request->user();
        $friend = User::findOrFail($userId);
        abort_unless($this->areFriends($user->id, $friend->id), 403, 'Messaging is available only between friends.');

        $messages = $this->messagesBetween($user->id, $friend->id)
            ->orderBy('created_at')
            ->limit(200)
            ->get()
            ->map(fn (DirectMessage $message) => $this->formatMessage($message));

        return response()->json([
            'user' => $this->formatUser($friend, $user->id),
            'messages' => $messages,
        ]);
    }

    public function store(Request $request, int $userId): JsonResponse
    {
        $user = $request->user();
        $friend = User::findOrFail($userId);
        abort_unless($this->areFriends($user->id, $friend->id), 403, 'Messaging is available only between friends.');
        abort_if($this->isBlocked($user->id, $friend->id), 403, 'Messaging is blocked.');

        $validated = $request->validate([
            'body' => ['nullable', 'string', 'max:2000', new PassesModeration(ModerationMode::Medium), new PassesAiModeration('direct_message')],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
        ]);
        abort_if(blank($validated['body'] ?? null) && ! $request->hasFile('photo'), 422, 'Message or photo is required.');

        $body = trim((string) ($validated['body'] ?? ''));
        if ($body !== '') {
            $this->enforceSpamLimit($user->id, $friend->id, $body);
        }

        $message = DirectMessage::create([
            'sender_id' => $user->id,
            'recipient_id' => $friend->id,
            'body' => $body !== '' ? $body : null,
            'photo_path' => $request->file('photo')?->store('direct-messages', 'public'),
        ]);

        return response()->json(['data' => $this->formatMessage($message)], 201);
    }

    public function clear(Request $request, int $userId): JsonResponse
    {
        $messages = $this->messagesBetween($request->user()->id, $userId)->get();
        foreach ($messages as $message) {
            if ($message->photo_path) {
                Storage::disk('public')->delete($message->photo_path);
            }
            $message->delete();
        }

        return response()->json(['message' => 'Chat cleared.']);
    }

    public function block(Request $request, int $userId): JsonResponse
    {
        abort_if($request->user()->id === $userId, 422, 'You cannot block yourself.');
        User::findOrFail($userId);

        DB::table('user_blocks')->updateOrInsert(
            ['blocker_id' => $request->user()->id, 'blocked_id' => $userId],
            ['created_at' => now(), 'updated_at' => now()],
        );

        return response()->json(['message' => 'User blocked.', 'blocked' => true]);
    }

    public function unblock(Request $request, int $userId): JsonResponse
    {
        DB::table('user_blocks')
            ->where('blocker_id', $request->user()->id)
            ->where('blocked_id', $userId)
            ->delete();

        return response()->json(['message' => 'User unblocked.', 'blocked' => false]);
    }

    private function enforceSpamLimit(int $senderId, int $recipientId, string $body): void
    {
        $muteKey = "direct-message-mute:{$senderId}:{$recipientId}";
        if (Cache::has($muteKey)) {
            abort(429, 'Too many repeated messages. Try again in 5 seconds.');
        }

        $normalized = mb_strtolower(preg_replace('/\s+/u', ' ', trim($body)));
        $recent = DirectMessage::query()
            ->where('sender_id', $senderId)
            ->where('recipient_id', $recipientId)
            ->whereNotNull('body')
            ->latest()
            ->limit(2)
            ->pluck('body')
            ->map(fn (string $value) => mb_strtolower(preg_replace('/\s+/u', ' ', trim($value))));

        if ($recent->count() === 2 && $recent->every(fn (string $value) => $value === $normalized)) {
            Cache::put($muteKey, true, now()->addSeconds(5));
            abort(429, 'Too many repeated messages. Try again in 5 seconds.');
        }
    }

    private function friendIds(int $userId)
    {
        return DB::table('friendships')
            ->where('status', 'accepted')
            ->where(fn ($query) => $query->where('user_id', $userId)->orWhere('friend_id', $userId))
            ->get()
            ->map(fn ($friendship) => $friendship->user_id === $userId ? $friendship->friend_id : $friendship->user_id)
            ->unique();
    }

    private function areFriends(int $firstId, int $secondId): bool
    {
        return DB::table('friendships')
            ->where('status', 'accepted')
            ->where(fn ($query) => $query
                ->where(fn ($q) => $q->where('user_id', $firstId)->where('friend_id', $secondId))
                ->orWhere(fn ($q) => $q->where('user_id', $secondId)->where('friend_id', $firstId)))
            ->exists();
    }

    private function isBlocked(int $firstId, int $secondId): bool
    {
        return DB::table('user_blocks')
            ->where(fn ($query) => $query
                ->where(fn ($q) => $q->where('blocker_id', $firstId)->where('blocked_id', $secondId))
                ->orWhere(fn ($q) => $q->where('blocker_id', $secondId)->where('blocked_id', $firstId)))
            ->exists();
    }

    private function messagesBetween(int $firstId, int $secondId)
    {
        return DirectMessage::query()->where(fn ($query) => $query
            ->where(fn ($q) => $q->where('sender_id', $firstId)->where('recipient_id', $secondId))
            ->orWhere(fn ($q) => $q->where('sender_id', $secondId)->where('recipient_id', $firstId)));
    }

    private function formatUser(User $user, int $viewerId): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'avatar' => $user->avatar,
            'custom_status' => $user->custom_status,
            'is_online' => (bool) $user->is_online,
            'selected_profile_frame' => $user->selected_profile_frame ?: 'none',
            'is_blocked' => DB::table('user_blocks')->where('blocker_id', $viewerId)->where('blocked_id', $user->id)->exists(),
        ];
    }

    private function formatMessage(DirectMessage $message): array
    {
        return [
            'id' => $message->id,
            'sender_id' => $message->sender_id,
            'recipient_id' => $message->recipient_id,
            'body' => $message->body,
            'photo_path' => $message->photo_path,
            'created_at' => $message->created_at?->toISOString(),
        ];
    }
}
