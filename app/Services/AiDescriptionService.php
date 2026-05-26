<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiDescriptionService
{
    /**
     * Генерирует описание для аниме с помощью Google Gemini API
     *
     * @param string $animeTitle Название аниме
     * @return string|null Сгенерированное описание или null в случае ошибки
     */
    public function generateDescription(string $animeTitle): ?string
    {
        $apiKey = config('services.gemini.key') ?? env('GEMINI_API_KEY');

        if (empty($apiKey)) {
            Log::warning("AI Generator: GEMINI_API_KEY is not set in .env");
            return null;
        }

        $prompt = "Напиши интересное, интригующее и привлекательное описание для аниме '{$animeTitle}' на русском языке. Около 3-5 предложений. Без спойлеров. Не пиши вступительных фраз вроде 'Вот описание', выдай только сам текст описания.";

        try {
            $response = Http::timeout(30)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'maxOutputTokens' => 800,
                    ]
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
                
                if ($text) {
                    return trim($text);
                }
            } else {
                Log::error("Gemini API Error for '{$animeTitle}': " . $response->body());
            }

        } catch (\Exception $e) {
            Log::error("Gemini API Exception for '{$animeTitle}': " . $e->getMessage());
        }

        return null;
    }
}
