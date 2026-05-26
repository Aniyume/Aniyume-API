<?php

namespace App\Application\Queries\Friendships;

use App\Application\Services\Friendships\FriendshipUserFormatter;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SearchUsersForFriendshipQuery
{
    public function __construct(private readonly FriendshipUserFormatter $formatter)
    {
    }

    public function search(User $user, string $query): Collection
    {
        $users = User::where('id', '!=', $user->id)
            ->select('id', 'name', 'avatar', 'custom_status', 'is_online')
            ->limit(20)
            ->when(
                DB::connection()->getDriverName() === 'pgsql',
                fn ($builder) => $builder->where('name', 'ilike', '%' . $query . '%'),
                fn ($builder) => $builder->whereRaw('LOWER(name) LIKE ?', ['%' . mb_strtolower($query) . '%']),
            )
            ->get();

        return $users->map(fn (User $foundUser) => $this->formatter->format($foundUser));
    }
}
