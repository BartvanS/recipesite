<?php

declare(strict_types=1);

namespace App\Http\Controllers;

final class MyRecipesController extends Controller
{
    public function __invoke()
    {
        return view('recipes.my-recipes');
    }
}
