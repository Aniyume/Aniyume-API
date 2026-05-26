<?php

namespace App\Application\Services\Moderation;

use App\Domain\Moderation\ModerationMode;
use App\Domain\Moderation\ModerationResult;

class ProfanityModerationService
{
    /** @var array<string, array{categories: list<string>}> */
    private array $modes;

    /** @var array<string, array{terms: list<string>}> */
    private array $categories;

    public function __construct()
    {
        /** @var array<string, array{categories: list<string>}> $modes */
        $modes = config('moderation.modes', []);
        /** @var array<string, array{terms: list<string>}> $categories */
        $categories = config('moderation.categories', []);

        $this->modes = $modes;
        $this->categories = $categories;
    }

    public function check(string $text, ModerationMode|string|null $mode = null): ModerationResult
    {
        $mode = $this->resolveMode($mode);
        $normalized = $this->normalize($text);
        $compact = preg_replace('/[^\p{L}\p{N}]+/u', '', $normalized) ?? $normalized;

        $matchedCategories = [];
        $matchedTerms = [];

        foreach ($this->modes[$mode->value]['categories'] ?? [] as $category) {
            foreach ($this->categories[$category]['terms'] ?? [] as $term) {
                $normalizedTerm = $this->normalize($term);
                $compactTerm = preg_replace('/[^\p{L}\p{N}]+/u', '', $normalizedTerm) ?? $normalizedTerm;

                if ($normalizedTerm === '' || $compactTerm === '') {
                    continue;
                }

                if (str_contains($normalized, $normalizedTerm) || str_contains($compact, $compactTerm)) {
                    $matchedCategories[] = $category;
                    $matchedTerms[] = $term;
                }
            }
        }

        $matchedCategories = array_values(array_unique($matchedCategories));
        $matchedTerms = array_values(array_unique($matchedTerms));

        return new ModerationResult(
            allowed: $matchedCategories === [],
            mode: $mode,
            categories: $matchedCategories,
            matchedTerms: $matchedTerms,
        );
    }

    private function resolveMode(ModerationMode|string|null $mode): ModerationMode
    {
        if ($mode instanceof ModerationMode) {
            return $mode;
        }

        $mode ??= (string) config('moderation.default_mode', ModerationMode::Medium->value);

        return ModerationMode::tryFrom($mode) ?? ModerationMode::Medium;
    }

    private function normalize(string $text): string
    {
        $text = mb_strtolower($text);
        $text = strtr($text, [
            'ё' => 'е', '@' => 'а', '3' => 'з', '6' => 'б', '0' => 'о', '1' => 'и', '!' => 'и',
            '$' => 'с', '*' => '', '_' => '', '-' => '', '.' => '', ',' => '',
            'a' => 'а', 'b' => 'б', 'c' => 'с', 'e' => 'е', 'k' => 'к', 'm' => 'м', 'o' => 'о',
            'p' => 'р', 't' => 'т', 'x' => 'х', 'y' => 'у', 'i' => 'и', 'u' => 'у', 'd' => 'д',
        ]);

        return preg_replace('/\s+/u', ' ', trim($text)) ?? trim($text);
    }
}
