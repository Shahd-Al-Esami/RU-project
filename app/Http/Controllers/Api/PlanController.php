<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\PlanService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;

class PlanController extends Controller
{
    public  function storePlan($plan_order_id,PlanRequest $request)
    {
        $result = PlanService::storePlan($plan_order_id,$request);

        return response()->json(['message' => $result]);
    }

    public  function updatePlan($plan_order_id,PlanRequest $request,$plan_id)
    {
        $result = PlanService::updatePlan($plan_order_id,$request,$plan_id);

        return response()->json(['message' => $result]);
    }

    public  function deletePlan($id)
    {
        $result = PlanService::deletePlan($id);

        return response()->json(['message' => $result]);
    }

    //patient

    public  function getPlan($plan_order_id)
    {
        $result = PlanService::getPlan($plan_order_id);

        return response()->json(['message' => $result]);
    }
    public  function showPlan($plan_order_id)
    {
        $result = PlanService::showPlan($plan_order_id);

        return response()->json(['message' => $result]);
    }

    // public  function export($planId)
    // {
    //     $result = PlanService::export($planId);

    //     return response()->json(['message' => $result]);
    // }
}
