<?php
namespace App\Services;
use App\Models\Plan;
use App\Models\MealWeek;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;

class mealWeekService

{

use jsonTrait;

public static function storeMealWeek(Request $request,$plan_order_id){
    $plan_id=Plan::where('plan_order_id',$plan_order_id)->pluck('id');
    $mealWeek=MealWeek::create([
        'meal_id' =>$request->meal_id,
        'week_id' =>$request->week_id,
        'plan_id' =>$plan_id,
        'isDone' =>$request->isDone,
        'plan_order_id' =>$plan_order_id,
        'ingredient_food_id' =>$request->ingredient_food_id,
    ]);
    return jsonTrait::jsonResponse(200,'the meal of Week ',$mealWeek);

}

public static function updateMealWeek(Request $request,$plan_order_id,MealWeek $mealWeek){
    $plan_id=Plan::where('plan_order_id',$plan_order_id)->pluck('id');
    $meal=$mealWeek->update([
        'meal_id' =>$request->meal_id,
        'week_id' =>$request->week_id,
        'plan_id' =>$plan_id,
        'isDone' =>$request->isDone,
        'plan_order_id' =>$plan_order_id,
        'ingredient_food_id' =>$request->ingredient_food_id,
    ]);
    return jsonTrait::jsonResponse(200,'update meal of Week ',$meal);

}


public static function deleteMealWeek(MealWeek $mealWeek){
    $mealWeek->delete();

      return jsonTrait::jsonResponse(200,'delete mealWeek ',null);

    }



}
