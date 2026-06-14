<?php

namespace App\Http\Controllers\Api\V1;

use App\Application\Actions\WatchParty\AcceptInviteAction;
use App\Application\Actions\WatchParty\CloseRoomAction;
use App\Application\Actions\WatchParty\CreateRoomAction;
use App\Application\Actions\WatchParty\DeclineInviteAction;
use App\Application\Actions\WatchParty\InviteFriendAction;
use App\Application\Actions\WatchParty\JoinRoomAction;
use App\Application\Actions\WatchParty\LeaveRoomAction;
use App\Application\Actions\WatchParty\SendMessageAction;
use App\Application\Actions\WatchParty\SyncRoomStateAction;
use App\Application\Queries\WatchParty\FindActiveRoomQuery;
use App\Application\Queries\WatchParty\GetMessagesQuery;
use App\Application\Queries\WatchParty\ListInvitesQuery;
use App\Application\Services\WatchParty\FormatsWatchPartyResponses;
use App\Domain\Moderation\ModerationMode;
use App\Http\Controllers\Controller;
use App\Http\Rules\PassesModeration;
use App\Models\WatchPartyInvite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WatchPartyController extends Controller
{
    use FormatsWatchPartyResponses;

    public function create(Request $request, CreateRoomAction $action): JsonResponse
    {
        $maxParticipants = $request->user()->is_premium ? 10 : 2;
        $data = $request->validate([
            'anime_id' => 'required|exists:anime,id',
            'episode_number' => 'required|integer|min:1',
            'max_participants' => "integer|min:2|max:{$maxParticipants}",
            'is_private' => 'boolean',
        ]);

        return response()->json($action->execute($request->user(), $data), 201);
    }

    public function show(Request $request, string $code, FindActiveRoomQuery $query): JsonResponse
    {
        return response()->json($this->formatRoom($query->getByCode($code)));
    }

    public function join(Request $request, string $code, JoinRoomAction $action): JsonResponse
    {
        return response()->json($action->execute($request->user(), $code));
    }

    public function leave(Request $request, string $code, LeaveRoomAction $action): JsonResponse
    {
        $action->execute($request->user(), $code);

        return response()->json(['message' => 'Покинул комнату']);
    }

    public function sync(Request $request, string $code, SyncRoomStateAction $action): JsonResponse
    {
        $data = $request->validate([
            'current_time' => 'required|numeric|min:0',
            'is_playing' => 'required|boolean',
            'episode_number' => 'required|integer|min:1',
        ]);

        $action->execute($request->user(), $code, $data);

        return response()->json(['success' => true]);
    }

    public function sendMessage(Request $request, string $code, SendMessageAction $action): JsonResponse
    {
        $data = $request->validate([
            'message' => ['required', 'string', 'max:500', new PassesModeration(ModerationMode::Medium)],
        ]);

        return response()->json($action->execute($request->user(), $code, $data['message']), 201);
    }

    public function getMessages(Request $request, string $code, GetMessagesQuery $query): JsonResponse
    {
        return response()->json($query->get($code));
    }

    public function invite(Request $request, string $code, InviteFriendAction $action): JsonResponse
    {
        $data = $request->validate([
            'friend_id' => 'required|exists:users,id',
        ]);

        $action->execute($request->user(), $code, $data['friend_id']);

        return response()->json(['message' => 'Приглашение отправлено']);
    }

    public function invites(Request $request, ListInvitesQuery $query): JsonResponse
    {
        return response()->json($query->getFor($request->user()));
    }

    public function acceptInvite(Request $request, WatchPartyInvite $invite, AcceptInviteAction $action): JsonResponse
    {
        $action->execute($request->user(), $invite);

        return response()->json(['message' => 'Приглашение принято']);
    }

    public function declineInvite(Request $request, WatchPartyInvite $invite, DeclineInviteAction $action): JsonResponse
    {
        $action->execute($request->user(), $invite);

        return response()->json(['message' => 'Приглашение отклонено']);
    }

    public function close(Request $request, string $code, CloseRoomAction $action): JsonResponse
    {
        $action->execute($request->user(), $code);

        return response()->json(['message' => 'Комната закрыта']);
    }
}
