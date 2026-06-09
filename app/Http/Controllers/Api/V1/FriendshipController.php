<?php

namespace App\Http\Controllers\Api\V1;

use App\Application\Actions\Friendships\AcceptFriendRequestAction;
use App\Application\Actions\Friendships\DeclineOrRemoveFriendshipAction;
use App\Application\Actions\Friendships\SendFriendRequestAction;
use App\Application\Queries\Friendships\CountIncomingFriendRequestsQuery;
use App\Application\Queries\Friendships\ListFriendRequestsQuery;
use App\Application\Queries\Friendships\ListFriendsQuery;
use App\Application\Queries\Friendships\ResolveFriendshipStatusQuery;
use App\Application\Queries\Friendships\SearchUsersForFriendshipQuery;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\UserProfileService;

class FriendshipController extends Controller
{
    public function __construct(
        private readonly ListFriendsQuery $friends,
        private readonly ListFriendRequestsQuery $friendRequests,
        private readonly SendFriendRequestAction $sendFriendRequest,
        private readonly AcceptFriendRequestAction $acceptFriendRequest,
        private readonly DeclineOrRemoveFriendshipAction $declineOrRemoveFriendship,
        private readonly ResolveFriendshipStatusQuery $friendshipStatus,
        private readonly SearchUsersForFriendshipQuery $searchUsers,
        private readonly CountIncomingFriendRequestsQuery $incomingFriendRequests,
    ) {}

    // GET /friends — список принятых друзей
    public function index(Request $request): JsonResponse
    {
        return response()->json($this->friends->getFor($request->user()));
    }

    // GET /friends/requests — входящие заявки
    public function requests(Request $request): JsonResponse
    {
        return response()->json($this->friendRequests->getFor($request->user()));
    }

    // POST /friends/{userId} — отправить заявку
    public function send(Request $request, int $userId): JsonResponse
    {
        $result = $this->sendFriendRequest->execute($request->user(), $userId);

        return response()->json($result['payload'], $result['status']);
    }

    public function sendByNickname(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nickname' => ['required', 'string', 'min:1', 'max:255'],
        ]);

        $nickname = trim($validated['nickname']);
        $target = User::query()
            ->whereRaw('LOWER(name) = ?', [mb_strtolower($nickname)])
            ->first();

        if (! $target) {
            return response()->json(['message' => 'User with this nickname was not found'], 404);
        }

        $result = $this->sendFriendRequest->execute($request->user(), $target->id);

        return response()->json($result['payload'], $result['status']);
    }

    // POST /friends/{userId}/accept — принять заявку
    public function accept(Request $request, int $userId): JsonResponse
    {
        $this->acceptFriendRequest->execute($request->user(), $userId);

        return response()->json(['message' => 'Заявка принята']);
    }

    // POST /friends/{userId}/decline — отклонить или удалить из друзей
    public function decline(Request $request, int $userId): JsonResponse
    {
        $this->declineOrRemoveFriendship->execute($request->user(), $userId);

        return response()->json(['message' => 'Удалено']);
    }

    // GET /friends/{userId}/status — статус дружбы с пользователем
    public function status(Request $request, int $userId): JsonResponse
    {
        return response()->json($this->friendshipStatus->resolve($request->user(), $userId));
    }

    // GET /users/search?q=name — поиск пользователей
    public function search(Request $request): JsonResponse
    {
        $request->validate(['q' => 'required|string|min:2|max:50']);

        return response()->json($this->searchUsers->search($request->user(), $request->q));
    }

    public function profile(Request $request, int $userId): JsonResponse
    {
        $target = User::findOrFail($userId);

        $friendship = $this->friendshipStatus->resolve($request->user(), $target->id);
        $profile = app(UserProfileService::class)->getFullProfile($target);
        unset($profile['user']['email'], $profile['profile_frames']);
        $profile['user']['is_online'] = (bool) $target->is_online;
        $profile['user']['friendship_status'] = $friendship['status'];
        $profile['user']['is_sender'] = $friendship['is_sender'] ?? null;

        return response()->json($profile);
    }

    // GET /friends/count — количество входящих заявок (для badge)
    public function requestsCount(Request $request): JsonResponse
    {
        return response()->json([
            'count' => $this->incomingFriendRequests->countFor($request->user()),
        ]);
    }

    private function countFriends(int $userId): int
    {
        return DB::table('friendships')
            ->where('status', 'accepted')
            ->where(function ($query) use ($userId) {
                $query->where('user_id', $userId)->orWhere('friend_id', $userId);
            })
            ->count();
    }
}
