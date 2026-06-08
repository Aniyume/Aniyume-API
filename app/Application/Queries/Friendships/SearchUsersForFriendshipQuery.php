<?php

namespace App\Application\Queries\Friendships;

use App\Application\Services\Friendships\FriendshipUserFormatter;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SearchUsersForFriendshipQuery
{
    public function __construct(
        private readonly FriendshipUserFormatter $formatter,
        private readonly ResolveFriendshipStatusQuery $friendshipStatus,
    ) {}

    public function search(User $user, string $query): Collection
    {
        $users = User::where('id', '!=', $user->id)
            ->select('id', 'name', 'avatar', 'custom_status', 'is_online', 'selected_profile_frame')
            ->limit(20)
            ->where(function ($builder) use ($query) {
                $builder->when(
                    DB::connection()->getDriverName() === 'pgsql',
                    fn ($builder) => $builder->where('name', 'ilike', '%'.$query.'%'),
                    fn ($builder) => $builder->whereRaw('LOWER(name) LIKE ?', ['%'.mb_strtolower($query).'%']),
                );

                if (ctype_digit($query)) {
                    $builder->orWhere('id', (int) $query);
                }
            })
            ->get();

        return $users->map(function (User $foundUser) use ($user) {
            $status = $this->friendshipStatus->resolve($user, $foundUser->id);

            return $this->formatter->format($foundUser, [
                'friendship_status' => $status['status'],
                'is_sender' => $status['is_sender'] ?? null,
            ]);
        });
    }
}
