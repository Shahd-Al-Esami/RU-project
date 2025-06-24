<?php

namespace App\Http\Controllers\Api;

use App\Models\PlanOrder;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Services\PlanOrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientInformationRequest;
use App\Http\Requests\PlanOrderRequest;
use App\Models\PatientInformation;

class PlanOrderController extends Controller
{
     use jsonTrait;

//admin
public function countPlans()
{
    $plans = PlanOrderService::countPlans();
    return view('admin.dash' , compact ('plans'));
}

public function createPlanOrder()
{
    $doctors = PlanOrderService::createPlanOrder();
    return view('planOrder.create',['doctors'=>$doctors]);
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
        $planOrders = PlanOrderService::getPlanOrders();

return view('doctor.planOrders',['planOrders'=>$planOrders]);
    }


    public  function countPlanOrders()
    {
        $result = PlanOrderService::countPlanOrders();

        return response()->json(['message' => $result]);
    }


    public  function addPrice(Request $request)
    {
        $result = PlanOrderService::addPrice($request);

        return redirect()->route('getPlanOrders');
    }

    //patient

    public  function paid($planOrder_id,Request $request)
    {
        $result = PlanOrderService::paid($planOrder_id,$request);

        return response()->json(['message' => $result]);
    }


    public  function myOrdersPlans()
    {
        $planOrders = PlanOrderService::myOrdersPlans();

        return view('patient.plans',['planOrders'=>$planOrders]);
      }

    public  function storePlanOrder(PlanOrderRequest $request,PatientInformationRequest $req)
    {

        return PlanOrderService::storePlanOrder($request,$req);


    }

    public  function updatePlanOrder(PlanOrderRequest $request ,$id)
    {
        $result = PlanOrderService::updatePlanOrder($request,$id);

        return response()->json(['message' => $result]);
    }


}
