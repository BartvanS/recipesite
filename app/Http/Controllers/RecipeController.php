<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('recipes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('recipes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $validatedValues = $this->validateRecipe($request);
        $recipe = new Recipe();
        $recipe->title = $validatedValues['title'];
        $recipe->description = $validatedValues['description'];
        $recipe->hours = $validatedValues['hours'] ? $validatedValues['hours'] : 0;
        $recipe->minutes = $validatedValues['minutes'] ? $validatedValues['minutes'] : 0;
        $recipe->user_id = Auth::id();
        $recipe->save();
        return route('recipes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        return view('recipes.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $recipeId
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $recipeId)
    {
        $recipe = Recipe::find($recipeId);
//        dd($recipe);
//        if ($recipe->user->id == Auth::id()) {
            Recipe::destroy($recipeId);
//        }
        return redirect('recipes');
    }

    /**
     * Return the validated values if successfull
     *
     * @param $request
     * @return string[]
     */
    private function validateRecipe($request)
    {
        $validationValues = [
            'title' => 'required',
            'description' => 'required',
            'hours' => '',
            'minutes' => '',
        ];
        return $request->validate($validationValues);
    }

}
