<?php

namespace App\Http\Controllers\Api;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Services\PlanService;
use App\Http\Requests\PlanRequest;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

class PlanController extends Controller
{

    public  function addPlan($plan_order_id)
    {

     return view('doctor.addPlan',['plan_order_id'=>$plan_order_id]);
    }

    public  function editPlan($plan_order_id)
    {
          $plan=Plan::where('plan_order_id',$plan_order_id)->first();
     return view('doctor.addPlan',['plan_order_id'=>$plan_order_id,'plan'=>$plan]);
    }

    public  function storePlan($plan_order_id,PlanRequest $request)
    {
        $plan = PlanService::storePlan($plan_order_id,$request);

return view('doctor.plan',['plan'=>$plan]);
    }

    public  function updatePlan($plan_order_id,PlanRequest $request,$plan_id)
    {
        $plan = PlanService::updatePlan($plan_order_id,$request,$plan_id);
return redirect()->route('showPlan',$plan_order_id);
 }

    public  function deletePlan($id)
    {
        $result = PlanService::deletePlan($id);

        return response()->json(['message' => $result]);
    }

    //patient

    public  function getPlan($plan_order_id)
    {
        $plan = PlanService::getPlan($plan_order_id);

return view('patient.displayPlan',['plan'=>$plan])   ;
 }
    public  function showPlan($plan_order_id)
    {
        $plan = PlanService::showPlan($plan_order_id);

        return view('doctor.plan',['plan'=>$plan,'plan_order_id'=>$plan_order_id]);
  }

    // public  function export($planId)
    // {
    //     // dd('controller');
    //     $result = PlanService::export($planId);

    //     return response()->json(['message' => $result]);
    // }

}
