<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCanViewIndex()
    {
        $this->actingAs(User::factory()->admin()->create());

        $response = $this->get(route('categories.index'));

        $response->assertOk();
    }

    public function testCanViewCreate()
    {
        $this->actingAs(User::factory()->admin()->create());

        $response = $this->get(route('categories.create'));

        $response->assertOk();
    }

    public function testCanStoreCategory()
    {
        $this->actingAs(User::factory()->admin()->create());

        $response = $this->post(route('categories.store'), [
            'name' => 'Test',
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertRedirect(route('categories.index'));

        $this->assertDatabaseHas('categories', [
            'name' => 'Test',
        ]);
    }

    public function testCanViewEdit()
    {
        $category = Category::factory()->create();

        $this->actingAs(User::factory()->admin()->create());

        $response = $this->get(route('categories.edit', $category));

        $response->assertOk();
    }

    public function testCanUpdateCategory()
    {
        $category = Category::factory()->create();

        $this->actingAs(User::factory()->admin()->create());

        $response = $this->put(route('categories.update', $category), [
            'name' => 'Test',
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertRedirect(route('categories.index'));

        $this->assertDatabaseHas('categories', [
            'name' => 'Test',
        ]);
    }
}
