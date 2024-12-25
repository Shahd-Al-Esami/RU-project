<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Models\Meal;

class mealService
{

use jsonTrait;
//admin
public static function storeMeal(Request $request){
    $meal=Meal::create([
        'name' =>$request->name,

    ]);
    $meal->foods()->attach($request->food_ids);

  return jsonTrait::jsonResponse(200,'add meal successfully ',$meal);

}

public static function updateMeal(Request $request,Meal $meal){
    $meal->update([
        'name' =>$request->name,

    ]);
    $meal->foods()->sync($request->food_ids);

  return jsonTrait::jsonResponse(200,'update meal successfully ',$meal);

}

public static function deleteMeal(Meal $meal){
    $meal->delete();
  return jsonTrait::jsonResponse(200,'delete meal successfully ',null);

}


}
