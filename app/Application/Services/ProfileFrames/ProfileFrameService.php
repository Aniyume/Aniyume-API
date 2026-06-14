<?php

namespace App\Application\Services\ProfileFrames;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProfileFrameService
{
    /**
     * @return array<int, array<string, mixed>>
     */
    public function framesFor(User $user): array
    {
        $level = $this->level($user);
        $hasFrame67 = DB::table('comments')
            ->where('user_id', $user->id)
            ->whereNotNull('admin_hearted_at')
            ->where('comment', 'like', '%67%')
            ->exists();

        return array_map(function (array $frame) use ($user, $level, $hasFrame67) {
            $adminGranted = $frame['key'] !== 'none' && DB::table('user_profile_frames')
                ->where('user_id', $user->id)
                ->where('frame_key', $frame['key'])
                ->exists();
            $unlocked = $adminGranted || match ($frame['key']) {
                'none' => true,
                'ramka1000people' => $user->id <= 1000,
                'ramka67' => $hasFrame67,
                'ramka+5friend' => $this->friendsCount($user) >= 5,
                'ramka+10friend' => $this->friendsCount($user) >= 10,
                'ramka+25friend' => $this->friendsCount($user) >= 25,
                default => isset($frame['min_level']) && $level >= $frame['min_level'],
            };

            return [
                ...$frame,
                'unlocked' => $unlocked,
                'admin_granted' => $adminGranted,
                'selected' => ($user->selected_profile_frame ?: 'none') === $frame['key'],
            ];
        }, $this->catalog());
    }

    public function canSelect(User $user, string $key): bool
    {
        foreach ($this->framesFor($user) as $frame) {
            if ($frame['key'] === $key) {
                return (bool) $frame['unlocked'];
            }
        }

        return false;
    }

    public function canUserSelect(User $user, string $key): bool
    {
        if ($key === 'none') {
            return true;
        }

        $adminGranted = DB::table('user_profile_frames')
            ->where('user_id', $user->id)
            ->where('frame_key', $key)
            ->exists();

        return $adminGranted || ((bool) $user->is_premium && $this->canSelect($user, $key));
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function catalog(): array
    {
        return [
            ['key' => 'none', 'name' => 'Без рамки', 'image_path' => null],
            ['key' => 'ramka1000people', 'name' => 'Первые 1000', 'image_path' => '/images/ramka/ramka1000people.png'],
            ['key' => 'ramka1-10lvl', 'name' => 'Первые шаги', 'image_path' => '/images/ramka/ramka1-10lvl.png', 'min_level' => 1],
            ['key' => 'ramka11-20lvl', 'name' => 'Смотрящий', 'image_path' => '/images/ramka/ramka11-20lvl.png', 'min_level' => 11],
            ['key' => 'ramka21-30lvl', 'name' => 'Коллекционер серий', 'image_path' => '/images/ramka/ramka21-30lvl.png', 'min_level' => 21],
            ['key' => 'ramka31-40lvl', 'name' => 'Марафонец', 'image_path' => '/images/ramka/ramka31-40lvl.png', 'min_level' => 31],
            ['key' => 'ramka41-50lvl', 'name' => 'Ветеран онгоингов', 'image_path' => '/images/ramka/ramka41-50lvl.png', 'min_level' => 41],
            ['key' => 'ramka51-60lvl', 'name' => 'Хранитель коллекции', 'image_path' => '/images/ramka/ramka51-60lvl.png', 'min_level' => 51],
            ['key' => 'ramka61-70lvl', 'name' => 'Обсидиановый ранг', 'image_path' => '/images/ramka/ramka61-70lvl.png', 'min_level' => 61],
            ['key' => 'ramka67', 'name' => 'Секретная рамка', 'image_path' => '/images/ramka/ramka67.png', 'secret' => true],
            ['key' => 'ramka+5friend', 'name' => '5 friends', 'image_path' => '/images/ramka/ramka+5friend.png'],
            ['key' => 'ramka+10friend', 'name' => '10 friends', 'image_path' => '/images/ramka/ramka+10friend.png'],
            ['key' => 'ramka+25friend', 'name' => '25 friends', 'image_path' => '/images/ramka/ramka+25friend.png'],
            ['key' => 'ramkaShark', 'name' => 'Shark', 'image_path' => '/images/ramka/ramkaShark.png', 'secret' => true],
            ['key' => 'ramkaUborka', 'name' => 'Uborka', 'image_path' => '/images/ramka/ramkaUborka.png', 'secret' => true],
        ];
    }

    private function friendsCount(User $user): int
    {
        return DB::table('friendships')
            ->where('status', 'accepted')
            ->where(fn ($query) => $query->where('user_id', $user->id)->orWhere('friend_id', $user->id))
            ->count();
    }

    private function level(User $user): int
    {
        $seconds = (int) DB::table('watch_history')->where('user_id', $user->id)->sum('watch_time');
        $minutes = max(0, intdiv($seconds, 60));
        if ($minutes < 20) {
            return 1;
        }
        if ($minutes < 50) {
            return 2;
        }
        $year = 365 * 3 * 60;
        $progress = min(1, ($minutes - 50) / max(1, $year - 50));

        return min(100, max(3, 3 + (int) floor($progress * 97)));
    }
}
