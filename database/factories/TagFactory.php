<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

final class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition(): array
    {
        return [
            'name' => fn () => $this->faker->sentence(3),
            'slug' => fn () => $this->faker->unique()->slug,
        ];
    }
}
