<?php

namespace Tests\Feature\Api;

use App\Jobs\ImportAnimeJob;
use App\Models\Anime;
use App\Models\ImportLog;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class AdminApiSkeletonTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_fetch_me(): void
    {
        $admin = $this->createAdminUser();

        $this->actingAs($admin, 'sanctum')
            ->getJson('/api/v1/admin/auth/me')
            ->assertOk()
            ->assertJsonPath('data.id', $admin->id)
            ->assertJsonPath('data.is_admin', true)
            ->assertJsonPath('data.roles.0', 'admin');
    }

    public function test_non_admin_cannot_access_admin_api(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/admin/dashboard')
            ->assertForbidden()
            ->assertJsonPath('message', 'Access denied');
    }

    public function test_admin_can_fetch_dashboard(): void
    {
        $admin = $this->createAdminUser();
        Anime::factory()->count(2)->create(['status' => 'ongoing', 'type' => 'tv']);
        ImportLog::create([
            'import_type' => 'update',
            'status' => 'completed',
            'started_at' => now()->subMinute(),
            'finished_at' => now(),
        ]);

        $this->actingAs($admin, 'sanctum')
            ->getJson('/api/v1/admin/dashboard')
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'summary' => ['total_anime', 'total_episodes', 'total_tags', 'total_users'],
                    'recent_imports',
                    'anime_by_status',
                    'anime_by_type',
                    'latest_anime',
                ],
            ])
            ->assertJsonPath('data.summary.total_anime', 2)
            ->assertJsonPath('data.recent_imports.0.import_type', 'update');
    }

    public function test_admin_can_check_configured_monitoring_service(): void
    {
        $admin = $this->createAdminUser();
        config(['services.monitoring.grafana.url' => 'http://grafana:3000']);
        Http::fake([
            'http://grafana:3000/api/health' => Http::response(['database' => 'ok'], 200),
        ]);

        $this->actingAs($admin, 'sanctum')
            ->getJson('/api/v1/admin/monitoring/health?target=grafana')
            ->assertOk()
            ->assertJsonPath('data.configured', true)
            ->assertJsonPath('data.ok', true)
            ->assertJsonPath('data.status', 200);

        Http::assertSent(fn ($request) => $request->url() === 'http://grafana:3000/api/health');
    }

    public function test_admin_monitoring_health_reports_unconfigured_service(): void
    {
        $admin = $this->createAdminUser();
        config(['services.monitoring.nocodb.url' => null]);

        $this->actingAs($admin, 'sanctum')
            ->getJson('/api/v1/admin/monitoring/health?target=nocodb')
            ->assertOk()
            ->assertJsonPath('data.configured', false)
            ->assertJsonPath('data.ok', false)
            ->assertJsonPath('data.status', null);

        Http::assertNothingSent();
    }

    public function test_admin_monitoring_health_rejects_unknown_target(): void
    {
        $admin = $this->createAdminUser();

        $this->actingAs($admin, 'sanctum')
            ->getJson('/api/v1/admin/monitoring/health?target=unknown')
            ->assertUnprocessable();
    }

    public function test_admin_can_fetch_filtered_anime_list(): void
    {
        $admin = $this->createAdminUser();
        $tag = Tag::factory()->create();
        $matchingAnime = Anime::factory()->create([
            'title' => 'Skeleton Anime',
            'status' => 'ongoing',
            'type' => 'tv',
        ]);
        $matchingAnime->tags()->attach($tag);
        Anime::factory()->create(['title' => 'Other Title', 'status' => 'finished']);

        $this->actingAs($admin, 'sanctum')
            ->getJson('/api/v1/admin/anime?search=Skeleton&status=ongoing&per_page=10')
            ->assertOk()
            ->assertJsonPath('data.0.id', $matchingAnime->id)
            ->assertJsonPath('data.0.tags.0.id', $tag->id)
            ->assertJsonPath('meta.total', 1)
            ->assertJsonStructure(['data', 'links', 'meta']);
    }

    public function test_admin_can_fetch_imports_dashboard_and_logs(): void
    {
        $admin = $this->createAdminUser();
        ImportLog::create([
            'import_type' => 'initial',
            'status' => 'running',
            'started_at' => now(),
        ]);
        ImportLog::create([
            'import_type' => 'update',
            'status' => 'completed',
            'started_at' => now()->subMinutes(2),
            'finished_at' => now()->subMinute(),
        ]);

        $this->actingAs($admin, 'sanctum')
            ->getJson('/api/v1/admin/imports/dashboard')
            ->assertOk()
            ->assertJsonPath('data.stats.total_imports', 2)
            ->assertJsonPath('data.stats.successful_imports', 1)
            ->assertJsonPath('data.stats.running_imports', 1);

        $this->actingAs($admin, 'sanctum')
            ->getJson('/api/v1/admin/imports/logs?status=completed&type=update')
            ->assertOk()
            ->assertJsonPath('meta.total', 1)
            ->assertJsonPath('data.0.import_type', 'update')
            ->assertJsonPath('data.0.status', 'completed')
            ->assertJsonStructure(['data', 'links', 'meta']);
    }

    public function test_admin_can_create_update_and_delete_anime(): void
    {
        $admin = $this->createAdminUser();
        $tag = Tag::factory()->create();
        $newTag = Tag::factory()->create();

        $createResponse = $this->actingAs($admin, 'sanctum')
            ->postJson('/api/v1/admin/anime', [
                'title' => 'Admin API Anime',
                'description' => 'Created through JSON admin API.',
                'poster_url' => 'https://example.com/poster.jpg',
                'rating' => 8.5,
                'status' => 'ongoing',
                'type' => 'tv',
                'year' => 2026,
                'number_of_episodes' => 12,
                'nsfw_flag' => true,
                'tags' => [$tag->id],
            ])
            ->assertCreated()
            ->assertJsonPath('data.title', 'Admin API Anime')
            ->assertJsonPath('data.slug', 'admin-api-anime')
            ->assertJsonPath('data.tags.0.id', $tag->id);

        $animeId = $createResponse->json('data.id');
        $this->assertDatabaseHas('audit_logs', [
            'user_id' => $admin->id,
            'action' => 'create_anime',
        ]);

        $this->actingAs($admin, 'sanctum')
            ->patchJson("/api/v1/admin/anime/{$animeId}", [
                'title' => 'Updated Admin API Anime',
                'status' => 'finished',
                'tags' => [$newTag->id],
            ])
            ->assertOk()
            ->assertJsonPath('data.title', 'Updated Admin API Anime')
            ->assertJsonPath('data.slug', 'updated-admin-api-anime')
            ->assertJsonPath('data.status', 'finished')
            ->assertJsonPath('data.tags.0.id', $newTag->id);

        $anime = Anime::findOrFail($animeId);
        $anime->update(['external_id' => 'api-delete-1', 'external_source' => 'shikimori']);

        $this->actingAs($admin, 'sanctum')
            ->deleteJson("/api/v1/admin/anime/{$animeId}")
            ->assertNoContent();

        $this->assertDatabaseMissing('anime', ['id' => $animeId]);
        $this->assertDatabaseHas('blacklisted_anime', [
            'external_id' => 'api-delete-1',
            'external_source' => 'shikimori',
        ]);
        $this->assertDatabaseHas('audit_logs', [
            'user_id' => $admin->id,
            'action' => 'delete_anime',
        ]);
    }

    public function test_admin_can_create_update_and_delete_tags(): void
    {
        $admin = $this->createAdminUser();

        $createResponse = $this->actingAs($admin, 'sanctum')
            ->postJson('/api/v1/admin/tags', ['name' => 'Admin Tag'])
            ->assertCreated()
            ->assertJsonPath('data.name', 'Admin Tag')
            ->assertJsonPath('data.slug', 'admin-tag');

        $tagId = $createResponse->json('data.id');

        $this->actingAs($admin, 'sanctum')
            ->putJson("/api/v1/admin/tags/{$tagId}", ['name' => 'Updated Admin Tag'])
            ->assertOk()
            ->assertJsonPath('data.name', 'Updated Admin Tag')
            ->assertJsonPath('data.slug', 'updated-admin-tag');

        $this->actingAs($admin, 'sanctum')
            ->deleteJson("/api/v1/admin/tags/{$tagId}")
            ->assertNoContent();

        $this->assertDatabaseMissing('tags', ['id' => $tagId]);
        $this->assertDatabaseHas('audit_logs', [
            'user_id' => $admin->id,
            'action' => 'delete_tag',
        ]);
    }

    public function test_admin_can_run_import_from_api(): void
    {
        Queue::fake();

        $admin = $this->createAdminUser();

        $response = $this->actingAs($admin, 'sanctum')
            ->postJson('/api/v1/admin/imports/run', ['type' => 'update'])
            ->assertAccepted()
            ->assertJsonPath('data.import_type', 'update')
            ->assertJsonPath('data.status', 'running');

        $this->assertDatabaseHas('import_logs', [
            'id' => $response->json('data.id'),
            'import_type' => 'update',
            'status' => 'running',
        ]);
        $this->assertDatabaseHas('audit_logs', [
            'user_id' => $admin->id,
            'action' => 'run_import',
        ]);
        Queue::assertPushed(ImportAnimeJob::class, fn (ImportAnimeJob $job) => $job->importLogId === $response->json('data.id'));
    }

    public function test_non_admin_cannot_use_admin_write_api(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/admin/tags', ['name' => 'Blocked'])
            ->assertForbidden();
    }

    public function test_admin_can_grant_and_revoke_user_profile_frame(): void
    {
        $admin = $this->createAdminUser();
        $user = User::factory()->create();

        $this->actingAs($admin, 'sanctum')
            ->patchJson("/api/v1/admin/users/{$user->id}/frames/ramkaShark", ['enabled' => true])
            ->assertOk()
            ->assertJsonPath('data.admin_granted_profile_frames.0', 'ramkaShark');

        $this->assertDatabaseHas('user_profile_frames', [
            'user_id' => $user->id,
            'frame_key' => 'ramkaShark',
            'granted_by' => $admin->id,
        ]);

        $user->update(['selected_profile_frame' => 'ramkaShark']);

        $this->actingAs($admin, 'sanctum')
            ->patchJson("/api/v1/admin/users/{$user->id}/frames/ramkaShark", ['enabled' => false])
            ->assertOk()
            ->assertJsonPath('data.selected_profile_frame', 'none');

        $this->assertDatabaseMissing('user_profile_frames', ['user_id' => $user->id, 'frame_key' => 'ramkaShark']);
    }

    private function createAdminUser(): User
    {
        $admin = User::factory()->create();
        $role = Role::create(['name' => 'admin', 'display_name' => 'Admin']);

        $admin->roles()->attach($role);

        return $admin;
    }
}
