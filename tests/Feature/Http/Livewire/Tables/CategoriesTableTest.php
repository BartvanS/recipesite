<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Livewire\Tables;

use App\Http\Livewire\Tables\CategoriesTable;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

final class CategoriesTableTest extends TestCase
{
    use RefreshDatabase;

    public function testCanViewTable()
    {
        Category::factory()->create([
            'name' => 'Voorafje',
        ]);

        Livewire::test(CategoriesTable::class)
            ->assertSee('Voorafje');
    }

    public function testCanSearchCategories()
    {
        Category::factory()->create([
            'name' => 'Voorafje',
        ]);

        Livewire::test(CategoriesTable::class)
            ->assertSee('Voorafje')
            ->set('search', 'kaas')
            ->assertDontSee('Voorafje');
    }
}
