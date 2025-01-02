<?php

namespace App\Http\Controllers\Api;

use App\Models\PlanOrder;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Services\planOrderService;
use App\Http\Controllers\Controller;

class PlanOrderController extends Controller
{
     use jsonTrait;

//admin
public function countPlans()
{
    $result = planOrderService::countPlans();

    return response()->json(['message' => $result]);
}
    public function getAllPlanOrders()
    {
        $result = planOrderService::getAllPlanOrders();

        return response()->json(['message' => $result]);
    }
    public  function showPlanOrder($id)
    {
        $result = planOrderService::showPlanOrder($id);

        return response()->json(['message' => $result]);
    }

    public  function getPlanOrders()
    {
        $result = planOrderService::getPlanOrders();

        return response()->json(['message' => $result]);
    }


    public  function countPlanOrders()
    {
        $result = planOrderService::countPlanOrders();

        return response()->json(['message' => $result]);
    }


    public  function addPrice(Request $request,$planOrder_id)
    {
        $result = planOrderService::addPrice($request,$planOrder_id);

        return response()->json(['message' => $result]);
    }

    //patient

    public  function paid($planOrder_id,Request $request)
    {
        $result = planOrderService::paid($planOrder_id,$request);

        return response()->json(['message' => $result]);
    }


    public  function myOrdersPlans()
    {
        $result = planOrderService::myOrdersPlans();

        return response()->json(['message' => $result]);
    }

    public  function storePlanOrder(Request $request)
    {
        $result = planOrderService::storePlanOrder($request);

        return response()->json(['message' => $result]);
    }

    public  function updatePlanOrder(Request $request ,$id)
    {
        $result = planOrderService::updatePlanOrder($request,$id);

        return response()->json(['message' => $result]);
    }


}
