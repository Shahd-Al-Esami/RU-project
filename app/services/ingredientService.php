<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Models\Ingredient;

class IngredientService
{

use jsonTrait;
//admin
public static function storeIngredient(Request $request){
    $request->validate([
        'name' =>  'required', 'string', 'max:255',
        'calories' =>  'required', 'numeric',
    ]);
    $ingredient=Ingredient::create([
        'name'     =>$request->name,
        'calories' =>$request->calories,

    ]);
  return jsonTrait::jsonResponse(200,'add ingredient successfully ',$ingredient);

}

public static function updateingredient(Request $request, $id){
    $request->validate([
        'name' =>  'required', 'string', 'max:255',
        'calories' =>  'required', 'numeric',
    ]);
    $ingredient=Ingredient::findOrFail($id);

    $ingredient->update([
        'name'     =>$request->name,
        'calories' =>$request->calories,

    ]);
  return jsonTrait::jsonResponse(200,'update ingredient successfully ',$ingredient);

}

public static function deleteIngredient($id){
    $ingredient=Ingredient::findOrFail($id);
    $ingredient->delete();
  return jsonTrait::jsonResponse(200,'delete ingredient successfully ',null);

}
//doctor
public static function index(){

$ingredient=Ingredient::all();
    return jsonTrait::jsonResponse(200,'display ingredient  ',$ingredient);

}

}
