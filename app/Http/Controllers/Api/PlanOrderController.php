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

}
