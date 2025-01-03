<?php

namespace App\Http\Controllers\Api;

use App\Models\PlanOrder;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Services\PlanOrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlanOrderRequest;

class PlanOrderController extends Controller
{
     use jsonTrait;

//admin
public function countPlans()
{
    $result = PlanOrderService::countPlans();

    return response()->json(['message' => $result]);
}
    public function getAllPlanOrders()
    {
        $result = PlanOrderService::getAllPlanOrders();

        return response()->json(['message' => $result]);
    }
    public  function showPlanOrder($id)
    {
        $result = PlanOrderService::showPlanOrder($id);

        return response()->json(['message' => $result]);
    }

    public  function getPlanOrders()
    {
        $result = PlanOrderService::getPlanOrders();

        return response()->json(['message' => $result]);
    }


    public  function countPlanOrders()
    {
        $result = PlanOrderService::countPlanOrders();

        return response()->json(['message' => $result]);
    }


    public  function addPrice(Request $request,$planOrder_id)
    {
        $result = PlanOrderService::addPrice($request,$planOrder_id);

        return response()->json(['message' => $result]);
    }

    //patient

    public  function paid($planOrder_id,Request $request)
    {
        $result = PlanOrderService::paid($planOrder_id,$request);

        return response()->json(['message' => $result]);
    }


    public  function myOrdersPlans()
    {
        $result = PlanOrderService::myOrdersPlans();

        return response()->json(['message' => $result]);
    }

    public  function storePlanOrder(PlanOrderRequest $request)
    {
        $result = PlanOrderService::storePlanOrder($request);

        return response()->json(['message' => $result]);
    }

    public  function updatePlanOrder(PlanOrderRequest $request ,$id)
    {
        $result = PlanOrderService::updatePlanOrder($request,$id);

        return response()->json(['message' => $result]);
    }


}
