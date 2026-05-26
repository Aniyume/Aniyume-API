<?php

namespace Tests\Feature\Api;

use App\Models\Anime;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentsApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_comments_endpoint_is_accessible(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();
        Comment::create([
            'user_id' => $user->id,
            'anime_id' => $anime->id,
            'comment' => 'Approved public comment',
            'is_approved' => true,
        ]);
        Comment::create([
            'user_id' => $user->id,
            'anime_id' => $anime->id,
            'comment' => 'Hidden comment',
            'is_approved' => false,
        ]);

        $this->getJson("/api/v1/public/anime/{$anime->id}/comments")
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.comment', 'Approved public comment');
    }

    public function test_comment_mutation_endpoints_require_authentication(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();
        $comment = Comment::create([
            'user_id' => $user->id,
            'anime_id' => $anime->id,
            'comment' => 'Existing comment',
            'is_approved' => true,
        ]);

        $this->postJson('/api/v1/comments', [
            'anime_id' => $anime->id,
            'comment' => 'New comment',
        ])->assertUnauthorized();
        $this->putJson("/api/v1/comments/{$comment->id}", ['comment' => 'Updated comment'])->assertUnauthorized();
        $this->deleteJson("/api/v1/comments/{$comment->id}")->assertUnauthorized();
        $this->getJson('/api/v1/my-comments')->assertUnauthorized();
    }

    public function test_user_can_create_comment(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/comments', [
                'anime_id' => $anime->id,
                'comment' => 'Great anime comment',
            ])
            ->assertCreated()
            ->assertJsonPath('data.comment', 'Great anime comment')
            ->assertJsonPath('data.user_id', $user->id)
            ->assertJsonPath('data.anime_id', $anime->id);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'anime_id' => $anime->id,
            'comment' => 'Great anime comment',
        ]);
    }

    public function test_user_can_get_own_comments(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create(['title' => 'Commented Anime']);
        Comment::create([
            'user_id' => $user->id,
            'anime_id' => $anime->id,
            'comment' => 'My comment',
            'is_approved' => true,
        ]);

        $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/my-comments')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.comment', 'My comment')
            ->assertJsonPath('data.0.anime.title', 'Commented Anime');
    }

    public function test_user_can_update_own_comment(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();
        $comment = Comment::create([
            'user_id' => $user->id,
            'anime_id' => $anime->id,
            'comment' => 'Original comment',
            'is_approved' => true,
        ]);

        $this->actingAs($user, 'sanctum')
            ->putJson("/api/v1/comments/{$comment->id}", ['comment' => 'Updated comment'])
            ->assertOk()
            ->assertJsonPath('data.comment', 'Updated comment');

        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'comment' => 'Updated comment',
        ]);
    }

    public function test_user_can_delete_own_comment(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();
        $comment = Comment::create([
            'user_id' => $user->id,
            'anime_id' => $anime->id,
            'comment' => 'Delete me',
            'is_approved' => true,
        ]);

        $this->actingAs($user, 'sanctum')
            ->deleteJson("/api/v1/comments/{$comment->id}")
            ->assertOk()
            ->assertJsonPath('message', 'Deleted');

        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
        ]);
    }

    public function test_user_cannot_update_or_delete_another_users_comment(): void
    {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();
        $anime = Anime::factory()->create();
        $comment = Comment::create([
            'user_id' => $anotherUser->id,
            'anime_id' => $anime->id,
            'comment' => 'Another user comment',
            'is_approved' => true,
        ]);

        $this->actingAs($user, 'sanctum')
            ->putJson("/api/v1/comments/{$comment->id}", ['comment' => 'Hacked'])
            ->assertForbidden()
            ->assertJsonPath('message', 'Unauthorized');

        $this->actingAs($user, 'sanctum')
            ->deleteJson("/api/v1/comments/{$comment->id}")
            ->assertForbidden()
            ->assertJsonPath('message', 'Unauthorized');
    }

    public function test_invalid_comment_payload_returns_validation_error(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/comments', [
                'anime_id' => 999999,
                'comment' => 'no',
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['anime_id', 'comment']);
    }

    public function test_comment_text_must_pass_moderation(): void
    {
        $user = User::factory()->create();
        $anime = Anime::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/comments', [
                'anime_id' => $anime->id,
                'comment' => 'Ты идиот',
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['comment']);

        $this->assertDatabaseMissing('comments', [
            'user_id' => $user->id,
            'anime_id' => $anime->id,
            'comment' => 'Ты идиот',
        ]);
    }
}
