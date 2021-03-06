<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Recipe;
use App\Services\DurationConverter;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin Recipe
 */
final class RecipeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'author' => $this->user->id,
            'duration' => $this->duration,
            'duration_human' => DurationConverter::toHuman($this->duration),
            'duration_time' => DurationConverter::toTime($this->duration),
            'yield' => $this->yield,
            'image' => $this->image ? Storage::url($this->image) : null,
            'instructions' => $this->instructions->pluck('instruction'),
            'ingredients' => $this->ingredients->pluck('name'),
            'category' => $this->category->name,
            'tags' => $this->tags->pluck('name'),
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}
