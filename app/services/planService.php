<?php

namespace App\Services;



use App\Models\Food;
use App\Models\Plan;
use App\Models\User;
use App\Models\MealWeek;
use Barryvdh\DomPDF\PDF;
use App\Models\PlanOrder;
use App\Exports\PlanExport;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Http\Requests\PlanRequest;
use Maatwebsite\Excel\Facades\Excel;

class PlanService
{

use jsonTrait;
//doctor

public static function storePlan($plan_order_id,PlanRequest $request){

    $plan=Plan::create([
    'title'        =>$request->title,
    'start_date'   =>$request->start_date,
    'end_date'     =>$request->end_date,
    'plan_order_id'=>$plan_order_id,
    'state'        =>$request->state,
     ]);

    return jsonTrait::jsonResponse(200,'the plan ',$plan);

  }

  public static function updatePlan($plan_order_id,PlanRequest $request,$plan_id){
    $plan=Plan::findOrFail($plan_id);
    $plan->update([
    'title'         =>$request->title,
    'start_date'    =>$request->start_date,
    'end_date'      =>$request->end_date,
    'plan_order_id' =>$plan_order_id,
    'state'         =>$request->state,
     ]);

    return jsonTrait::jsonResponse(200,'update plan ',$plan);

  }
  public static function deletePlan($id){
    $plan=Plan::findOrFail($id);

     $plan->delete();

    return jsonTrait::jsonResponse(200,'delete plan ',null);

  }

//patient + doctor


public static function showPlan($plan_order_id){

    $plan=Plan::where('plan_order_id',$plan_order_id)->get();
    return jsonTrait::jsonResponse(200,' show plan ',$plan);

   }
//export excel

// public static function export($planId){
// //   $plan = Plan::findOrFail($planId);
// // dd('hi');
// $plan = Plan::find($planId);

// if (!$plan) {
//     return response()->json(['error' => 'Plan not found'], 404);
// }

// $export = new PlanExport($planId);
// return Excel::download($export, 'plan_' . $planId . '.xlsx');

//     //  return Excel::download(new PlanExport($planId),'plan_details.xlsx');
//    }






public static function getPlan($plan_order_id){

    $plan=Plan::where('plan_order_id',$plan_order_id)->with('descriptionPlans')->get();
    return jsonTrait::jsonResponse(200,'plan with its details',$plan);

   }


}
