<?php

namespace Tests\Unit\Services;

use App\Services\AllAnimeService;
use Tests\TestCase;

class AllAnimeServiceTest extends TestCase
{
    public function test_it_can_be_force_enabled_for_an_explicit_import(): void
    {
        config()->set('services.allanime.enabled', false);

        $service = app(AllAnimeService::class);

        $this->assertFalse($service->isEnabled());

        $service->forceEnable();

        $this->assertTrue($service->isEnabled());
    }
}
