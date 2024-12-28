<?php
namespace App\Services;
use App\Models\Plan;
use App\Models\MealWeek;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Models\DescriptionPlan;

class descriptionPlanService

{

use jsonTrait;

//for doctor
public static function storeDescriptionPlan(Request $request,$plan_id){

    $descriptionPlan=DescriptionPlan::create([
        'meal' =>$request->meal,
        'week' =>$request->week,
        'day' =>$request->day,
        'plan_id' =>$plan_id,
        'food_id' =>$request->food_id,
    ]);
    return jsonTrait::jsonResponse(200,'the description of plan ',$descriptionPlan);

}

public static function updateDescriptionPlan(Request $request,$plan_id,$id){

    $descriptionPlan=DescriptionPlan::findOrFail($id);
    $descriptionPlan=$descriptionPlan->update([
        'meal' =>$request->meal,
        'week' =>$request->week,
        'day' =>$request->day,
        'plan_id' =>$plan_id,
        'food_id' =>$request->food_id,
    ]);
    return jsonTrait::jsonResponse(200,'update description of Plan  ',$descriptionPlan);

}


public static function deleteDescriptionPlan($id){
    $descriptionPlan=DescriptionPlan::findOrFail($id);

    $descriptionPlan->delete();

      return jsonTrait::jsonResponse(200,'delete description of Plan ',null);

    }
//for patient
    public static function isDone($id){
        $descriptionPlan=DescriptionPlan::findOrFail($id);

        $descriptionPlan->isDone=1;

        $descriptionPlan->save();
          return jsonTrait::jsonResponse(200,'done for this day ',null);

        }

        public static function show($id){
            $descriptionPlan=DescriptionPlan::where('id',$id)->get();


              return jsonTrait::jsonResponse(200,'show description of Plan ',$descriptionPlan);

            }
            public static function index($id){
                $descriptionPlan=DescriptionPlan::where('plan_id',$id)->get();


                  return jsonTrait::jsonResponse(200,'disply description of Plan ',$descriptionPlan);

                }

}
