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

public static function countPlan(){
    return count(Plan::all());
}
public static function storePlan($plan_order_id,PlanRequest $request){

    $plan=Plan::create([
    'title'        =>$request->title,
    'start_date'   =>$request->start_date,
    'end_date'     =>$request->end_date,
    'plan_order_id'=>$plan_order_id,
    'state'        =>$request->state,
     ]);

return $plan;
  }

  public static function updatePlan($plan_order_id,PlanRequest $request,$plan_id){
    $plan=Plan::findOrFail($plan_id);

    $plan->update([
        'title' => $request->input('title'),
        'state' => $request->input('state'),
        'plan_order_id' => $plan_order_id,
        'start_date' => $request->input('start_date'),
        'end_date' => $request->input('end_date'),
    ]);
return $plan;
    // Optionally, you could return a redirect instead of a view
    // return redirect()->route('showPlan', $plan->plan_order_id);
}

  public static function deletePlan($id){
    $plan=Plan::findOrFail($id);

     $plan->delete();

    return jsonTrait::jsonResponse(200,'delete plan ',null);

  }

//patient + doctor


public static function showPlan($plan_order_id){

    $plan=Plan::where('plan_order_id',$plan_order_id)->with(['suggests','review'])->firstOrFail();
     return $plan;
   }







public static function getPlan($plan_order_id){

    $plan=Plan::where('plan_order_id',$plan_order_id)->with(['descriptionPlans','suggests','review'])->firstOrFail();
return $plan;
   }


}
