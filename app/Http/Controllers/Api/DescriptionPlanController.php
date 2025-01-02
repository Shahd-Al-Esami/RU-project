<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\descriptionPlanService;
use Illuminate\Http\Request;

class DescriptionPlanController extends Controller
{
    public  function storeDescriptionPlan(Request $request,$plan_id)
    {
        $result = descriptionPlanService::storeDescriptionPlan($request,$plan_id);

        return response()->json(['message' => $result]);
    }
    public  function updateDescriptionPlan(Request $request,$plan_id,$id)
    {
        $result = descriptionPlanService::updateDescriptionPlan($request,$plan_id,$id);

        return response()->json(['message' => $result]);
    }

    public  function deleteDescriptionPlan($id)
    {
        $result = descriptionPlanService::deleteDescriptionPlan($id);

        return response()->json(['message' => $result]);
    }
    
//patient
    public  function show($id)
    {
        $result = descriptionPlanService::show($id);

        return response()->json(['message' => $result]);
    }
    public  function index($id)
    {
        $result = descriptionPlanService::index($id);

        return response()->json(['message' => $result]);
    }

    public  function isDone($id)
    {
        $result = descriptionPlanService::isDone($id);

        return response()->json(['message' => $result]);
    }

 
}
