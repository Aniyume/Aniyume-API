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
            $unlocked = match ($frame['key']) {
                'none' => true,
                'ramka1000people' => $user->id <= 1000,
                'ramka67' => $hasFrame67,
                default => isset($frame['min_level']) && $level >= $frame['min_level'],
            };

            return [
                ...$frame,
                'unlocked' => $unlocked,
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
        ];
    }

    private function level(User $user): int
    {
        $seconds = (int) DB::table('watch_history')->where('user_id', $user->id)->sum('watch_time');
        $minutes = max(0, intdiv($seconds, 60));
        if ($minutes < 20) return 1;
        if ($minutes < 50) return 2;
        $year = 365 * 3 * 60;
        $progress = min(1, ($minutes - 50) / max(1, $year - 50));

        return min(100, max(3, 3 + (int) floor($progress * 97)));
    }
}
