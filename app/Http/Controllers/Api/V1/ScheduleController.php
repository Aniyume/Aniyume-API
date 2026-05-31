<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\AnimeResource;
use App\Models\Anime;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ScheduleController extends Controller
{
    /**
     * Получить реальное расписание онгоингов
     * Возвращает аниме, выходящие в разные дни недели (0-6, где 0 - Пн, 6 - Вс)
     */
    public function index()
    {
        // Кешируем на 1 час
        $schedule = Cache::remember('anime_schedule_v2', 3600, function () {
            try {
                // Официальный календарь Shikimori
                $response = Http::timeout(10)->get('https://shikimori.io/api/calendar');

                if (! $response->successful()) {
                    return $this->fallbackSchedule();
                }

                $calendarData = $response->json();

                // Извлекаем все shikimori IDs
                $shikimoriIds = collect($calendarData)->pluck('anime.id')->unique()->toArray();

                // Достаем из нашей базы те аниме, которые есть в календаре
                $animesFromDb = Anime::whereIn('shikimori_id', $shikimoriIds)
                    ->with(['tags'])
                    ->get()
                    ->keyBy('shikimori_id');

                // Группируем по дням недели. В JS 0=Вс, 1=Пн. В Shikimori даты в формате ISO
                // Но на фронтенде DAYS_INFO идет от 0=Пн до 6=Вс.
                $days = array_fill(0, 7, []);

                foreach ($calendarData as $item) {
                    $shikiId = $item['anime']['id'] ?? null;
                    if (! $shikiId || ! isset($animesFromDb[$shikiId])) {
                        continue;
                    }

                    $airDateString = $item['next_episode_at'] ?? null;
                    if (! $airDateString) {
                        continue;
                    }

                    // Парсим дату и получаем день недели
                    $date = \Carbon\Carbon::parse($airDateString)->timezone('Europe/Moscow');
                    $dayOfWeek = $date->dayOfWeekIso; // 1 (Пн) - 7 (Вс)

                    $dayIndex = $dayOfWeek - 1; // 0 (Пн) - 6 (Вс), совпадает с фронтендом

                    // Чтобы не добавлять одно аниме дважды в один день
                    $exists = collect($days[$dayIndex])->contains('id', $animesFromDb[$shikiId]->id);
                    if (! $exists) {
                        $days[$dayIndex][] = new AnimeResource($animesFromDb[$shikiId]);
                    }
                }

                return $days;

            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Schedule error: '.$e->getMessage());

                return $this->fallbackSchedule();
            }
        });

        // Преобразуем структуру для фронтенда (json.data[dayIndex] массивы)
        return response()->json([
            'success' => true,
            'data' => $schedule,
        ]);
    }

    /**
     * Запасное расписание, если API Shikimori недоступно
     */
    private function fallbackSchedule()
    {
        $ongoing = Anime::where('status', 'ongoing')
            ->orderBy('id', 'DESC')
            ->limit(50)
            ->get();

        $days = array_fill(0, 7, []);

        foreach ($ongoing as $anime) {
            $dayIndex = $anime->id % 7;
            $days[$dayIndex][] = new AnimeResource($anime);
        }

        return $days;
    }
}
