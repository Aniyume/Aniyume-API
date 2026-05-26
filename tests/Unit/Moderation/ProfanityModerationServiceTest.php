<?php

namespace Tests\Unit\Moderation;

use App\Application\Services\Moderation\ProfanityModerationService;
use App\Domain\Moderation\ModerationMode;
use Tests\TestCase;

class ProfanityModerationServiceTest extends TestCase
{
    public function test_soft_mode_blocks_profanity_and_obfuscated_profanity(): void
    {
        $service = new ProfanityModerationService();

        $this->assertFalse($service->check('Это блять плохо', ModerationMode::Soft)->allowed);
        $this->assertFalse($service->check('Это б л я плохо', ModerationMode::Soft)->allowed);
        $this->assertFalse($service->check('Это x y й плохо', ModerationMode::Soft)->allowed);
    }

    public function test_medium_mode_blocks_insults_but_soft_allows_them(): void
    {
        $service = new ProfanityModerationService();

        $this->assertTrue($service->check('Ты идиот', ModerationMode::Soft)->allowed);
        $this->assertFalse($service->check('Ты идиот', ModerationMode::Medium)->allowed);
    }

    public function test_strict_mode_blocks_toxic_phrases_but_medium_allows_basic_phrase(): void
    {
        $service = new ProfanityModerationService();

        $this->assertTrue($service->check('Просто сдохни', ModerationMode::Medium)->allowed);
        $this->assertFalse($service->check('Просто сдохни', ModerationMode::Strict)->allowed);
    }

    public function test_safe_text_is_allowed(): void
    {
        $service = new ProfanityModerationService();

        $this->assertTrue($service->check('Очень интересное аниме, спасибо за рекомендацию', ModerationMode::Strict)->allowed);
    }
}
