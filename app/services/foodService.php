<?php

namespace App\Services;
use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;

class FoodService
{

use jsonTrait;
//admin

public static function storeFood(Request $request){
    $request->validate([
        'name' =>  'required', 'string', 'max:255',
        'calories' =>  'required', 'numeric',
    ]);
    $food=Food::create([
        'name' =>$request->name,
        'calories' =>$request->calories,

    ]);

    $food->ingredients()->attach($request->ingredient_ids);

  return jsonTrait::jsonResponse(200,'add food successfully ',$food);

}

public static function updateFood(Request $request, $id){
    $request->validate([
        'name' =>  'required', 'string', 'max:255',
        'calories' =>  'required', 'numeric',
    ]);
    $food=Food::findOrFail($id);
    $food->update([
        'name' =>$request->name,
        'calories' =>$request->calories,

    ]);
    $food->ingredients()->sync($request->ingredient_ids);

  return jsonTrait::jsonResponse(200,'update food successfully ',$food);

}

public static function deleteFood($id){
    $food=Food::findOrFail($id);

    $food->delete();
  return jsonTrait::jsonResponse(200,'delete food successfully ',null);

}
//doctor

public static function index(){

    $food=Food::all();
        return jsonTrait::jsonResponse(200,'display food  ',$food);

    }
//patient +doctor
    public static function foodIngredient($id){

        $food=Food::where('id',$id)->with('ingredients')->get();
            return jsonTrait::jsonResponse(200,'display  food and its ingredients ',$food);

        }

}
