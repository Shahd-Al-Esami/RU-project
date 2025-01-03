<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DescriptionPlanService;
use Illuminate\Http\Request;

class DescriptionPlanController extends Controller
{
    public  function storeDescriptionPlan(Request $request,$plan_id)
    {
        $result = DescriptionPlanService::storeDescriptionPlan($request,$plan_id);

        return response()->json(['message' => $result]);
    }
    public  function updateDescriptionPlan(Request $request,$plan_id,$id)
    {
        $result = DescriptionPlanService::updateDescriptionPlan($request,$plan_id,$id);

        return response()->json(['message' => $result]);
    }

    public  function deleteDescriptionPlan($id)
    {
        $result = DescriptionPlanService::deleteDescriptionPlan($id);

        return response()->json(['message' => $result]);
    }

//patient
    public  function show($id)
    {
        $result = DescriptionPlanService::show($id);

        return response()->json(['message' => $result]);
    }
    public  function index($id)
    {
        $result = DescriptionPlanService::index($id);

        return response()->json(['message' => $result]);
    }

    public  function isDone($id)
    {
        $result = DescriptionPlanService::isDone($id);

        return response()->json(['message' => $result]);
    }


}
