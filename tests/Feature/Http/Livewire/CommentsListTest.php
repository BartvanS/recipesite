<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Livewire;

use App\Http\Livewire\CommentsList;
use App\Models\Comment;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

final class CommentsListTest extends TestCase
{
    use RefreshDatabase;

    public function testCanSubmitComment()
    {
        $this->actingAs(User::factory()->create());

        $recipe = Recipe::factory()->create();

        Livewire::test(CommentsList::class, [$recipe])
            ->set('message', 'hello')
            ->call('submit');

        $this->assertDatabaseHas('comments', [
            'message' => 'hello',
        ]);
    }

    public function testCanDeleteOwnComment()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $recipe = Recipe::factory()->create();

        $comment = Comment::factory()->create([
            'user_id' => $user,
            'recipe_id' => $recipe,
        ]);

        Livewire::test(CommentsList::class, [$recipe])
            ->call('delete', $comment->id)
            ->call('submit');

        $this->assertSoftDeleted($comment);
    }

    public function testCannotDeleteNonExistingComment()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $recipe = Recipe::factory()->create();

        Livewire::test(CommentsList::class, [$recipe])
            ->call('delete', 1)
            ->call('submit');
    }

    public function testCannotDeleteComment()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $recipe = Recipe::factory()->create();

        $comment = Comment::factory()->create([
            'recipe_id' => $recipe,
        ]);

        Livewire::test(CommentsList::class, [$recipe])
            ->call('delete', $comment->id)
            ->call('submit');

        $comment->refresh();

        $this->assertNull($comment->deleted_at);
    }

    public function testAdminCanDeleteComment()
    {
        $user = User::factory()->create([
            'is_admin' => true,
        ]);

        $this->actingAs($user);

        $recipe = Recipe::factory()->create();

        $comment = Comment::factory()->create([
            'recipe_id' => $recipe,
        ]);

        Livewire::test(CommentsList::class, [$recipe])
            ->call('delete', $comment->id)
            ->call('submit');

        $this->assertSoftDeleted($comment);
    }
}
