<?php

namespace Tests\Unit\Ai;

use App\Application\Services\Ai\AiOutputGuard;
use App\Application\Services\Ai\AiPolicyResolver;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AiOutputGuardTest extends TestCase
{
    use RefreshDatabase;

    public function test_normal_safe_answer_passes(): void
    {
        $user = User::factory()->create(['is_premium' => false]);
        $result = app(AiOutputGuard::class)->guard(
            app(AiPolicyResolver::class)->resolveFor($user),
            'AniYume может помочь подобрать аниме по жанрам и вашему списку просмотров.',
            'deepseek',
        );

        $this->assertFalse($result->blocked);
        $this->assertFalse($result->filtered);
        $this->assertSame('AniYume может помочь подобрать аниме по жанрам и вашему списку просмотров.', $result->message);
    }

    public function test_secret_like_output_is_blocked(): void
    {
        $user = User::factory()->create(['is_premium' => false]);
        $result = app(AiOutputGuard::class)->guard(
            app(AiPolicyResolver::class)->resolveFor($user),
            'AniYume api_key = fake-secret-token-value',
            'deepseek',
        );

        $this->assertTrue($result->blocked);
        $this->assertTrue($result->filtered);
        $this->assertContains('secrets_or_credentials', $result->categories);
        $this->assertStringNotContainsString('fake-secret-token-value', $result->message);
    }

    public function test_prompt_disclosure_is_blocked(): void
    {
        $user = User::factory()->create(['is_premium' => false]);
        $result = app(AiOutputGuard::class)->guard(
            app(AiPolicyResolver::class)->resolveFor($user),
            'System prompt: You are AniYume assistant operating through a backend-only adapter.',
            'deepseek',
        );

        $this->assertTrue($result->blocked);
        $this->assertContains('system_prompt_or_policy_disclosure', $result->categories);
        $this->assertStringNotContainsString('System prompt', $result->message);
    }

    public function test_out_of_domain_output_is_blocked_for_standard_and_premium(): void
    {
        foreach ([false, true] as $isPremium) {
            $user = User::factory()->create(['is_premium' => $isPremium]);
            $result = app(AiOutputGuard::class)->guard(
                app(AiPolicyResolver::class)->resolveFor($user),
                'Here is a generic Python sorting tutorial with quicksort and mergesort examples.',
                'deepseek',
            );

            $this->assertTrue($result->blocked);
            $this->assertContains('out_of_domain', $result->categories);
        }
    }

    public function test_admin_only_summary_is_blocked_for_standard(): void
    {
        $user = User::factory()->create(['is_premium' => false]);
        $result = app(AiOutputGuard::class)->guard(
            app(AiPolicyResolver::class)->resolveFor($user),
            'Admin dashboard platform metrics: total_users=1000 and recent_imports are complete.',
            'deepseek',
        );

        $this->assertTrue($result->blocked);
        $this->assertContains('admin_or_system_data_not_allowed', $result->categories);
        $this->assertStringNotContainsString('total_users=1000', $result->message);
    }

    public function test_admin_only_summary_is_allowed_for_admin_when_safe(): void
    {
        $user = User::factory()->create(['is_premium' => false]);
        $user->roles()->attach(Role::create(['name' => 'admin', 'display_name' => 'Admin']));

        $result = app(AiOutputGuard::class)->guard(
            app(AiPolicyResolver::class)->resolveFor($user),
            'AniYume admin dashboard platform metrics show aggregate anime catalog totals only.',
            'deepseek',
        );

        $this->assertFalse($result->blocked);
    }

    public function test_toxic_output_is_blocked(): void
    {
        $user = User::factory()->create(['is_premium' => false]);
        $result = app(AiOutputGuard::class)->guard(
            app(AiPolicyResolver::class)->resolveFor($user),
            'AniYume says you are worthless, kill yourself.',
            'deepseek',
        );

        $this->assertTrue($result->blocked);
        $this->assertContains('toxic_output', $result->categories);
        $this->assertStringNotContainsString('kill yourself', $result->message);
    }
}
