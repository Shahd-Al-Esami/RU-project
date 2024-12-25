<?php

namespace App\Services;



use App\Models\Plan;
use App\Models\MealWeek;
use App\Models\PlanOrder;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;

class planService
{

use jsonTrait;
//doctor


// public static function showPlan($plan_id){
//   $plan=Plan::findOrfail($plan_id)->with('mealWeeks')->get();
//   return jsonTrait::jsonResponse(200,'plan with its details',$plan);

// }

public static function getPlan($plan_order_id){
$plan=Plan::where('plan_order_id',$plan_order_id)->with('mealWeeks')->get();
    return jsonTrait::jsonResponse(200,'plan with its details',$plan);

  }
public static function storePlan($plan_order_id,Request $request){
    $plan=Plan::create([
    'title' =>$request->title,
    'start_date' =>$request->start_date,
    'end_date' =>$request->end_date,
    'plan_order_id' =>$plan_order_id,
    'state' =>$request->state,
    'rate' =>$request->rate,
     ]);

    return jsonTrait::jsonResponse(200,'the plan ',$plan);

  }

  public static function updatePlan($plan_order_id,Request $request,Plan $plan){
    $plan->update([
    'title' =>$request->title,
    'start_date' =>$request->start_date,
    'end_date' =>$request->end_date,
    'plan_order_id' =>$plan_order_id,
    'state' =>$request->state,
    'rate' =>$request->rate,
     ]);

    return jsonTrait::jsonResponse(200,'update plan ',$plan);

  }
  public static function deletePlan(Plan $plan){
  $plan->delete();

    return jsonTrait::jsonResponse(200,'delete plan ',null);

  }


}
