<?php

namespace App\Services;
use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;

class foodService
{

use jsonTrait;
//admin
public static function storeFood(Request $request){
    $food=Food::create([
        'name' =>$request->name,
        'calories' =>$request->calories,

    ]);
    $food->ingredients()->attach($request->ingredient_ids);

  return jsonTrait::jsonResponse(200,'add food successfully ',$food);

}

public static function updateFood(Request $request,Food $food){
    $food->update([
        'name' =>$request->name,
        'calories' =>$request->calories,

    ]);
    $food->ingredients()->sync($request->ingredient_ids);

  return jsonTrait::jsonResponse(200,'update food successfully ',$food);

}

public static function deleteFood(Food $food){
    $food->delete();
  return jsonTrait::jsonResponse(200,'delete food successfully ',null);

}


}
