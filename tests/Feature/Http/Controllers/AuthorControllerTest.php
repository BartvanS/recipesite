<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class AuthorControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_example()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('author.show', User::factory()->create()));

        $response->assertOk();
    }
}
