<?php

namespace App\Jobs;

use App\Models\Anime;
use App\Services\AiDescriptionService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GenerateAnimeDescriptionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    public $backoff = [60, 120, 300]; // Задержка между попытками (секунды)

    protected Anime $anime;

    /**
     * Создание нового экземпляра задачи.
     */
    public function __construct(Anime $anime)
    {
        $this->anime = $anime;
    }

    /**
     * Выполнение задачи.
     */
    public function handle(AiDescriptionService $aiService): void
    {
        // Повторная проверка, возможно описание уже дописано вручную
        $this->anime->refresh();
        if (! empty($this->anime->description) && strlen($this->anime->description) > 20) {
            return;
        }

        $titleToSearch = $this->anime->title ?? $this->anime->slug;
        if (empty($titleToSearch)) {
            return;
        }

        Log::info("AI Generator: Generating description for '{$titleToSearch}'...");

        $description = $aiService->generateDescription($titleToSearch);

        if ($description) {
            $this->anime->description = $description;
            $this->anime->save();
            Log::info("AI Generator: Successfully updated description for '{$titleToSearch}'.");
        } else {
            // Если ошибка из-за 429 Too Many Requests (отломилось в сервисе),
            // мы можем выбросить Exception, чтобы job ушел в retry
            throw new \Exception("Failed to generate description for '{$titleToSearch}'. Retrying later.");
        }

        // Искусственная задержка 4 сек, чтобы не упереться в бесплатный лимит Gemini (15 RPM)
        sleep(4);
    }
}
