<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Recipe;

final class RecipeRepository
{
    public function store($request, $validatedValues)
    {
        $recipe = new Recipe();
        $recipe->fill($validatedValues);
        $recipe->user()->associate($request->user());
        $recipe->save();

        $recipe->ingredients()->saveMany($validatedValues['ingredients']);

        $recipe->instructions()->saveMany($validatedValues['instructions']);

        return $recipe;
    }

    public function update($request, $recipe, $validatedValues)
    {
        $recipe->update($validatedValues);

        $recipe->ingredients()->delete();
        $recipe->ingredients()->saveMany($validatedValues['ingredients']);

        $recipe->instructions()->delete();
        $recipe->instructions()->saveMany($validatedValues['instructions']);

        return $recipe;
    }
}