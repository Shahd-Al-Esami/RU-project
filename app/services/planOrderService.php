<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\PlanOrder;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;

class planOrderService
{

use jsonTrait;
//admin

public static function countPlans(){
    $countPlans=count(PlanOrder::all());
    return jsonTrait::jsonResponse(200, 'All plan orders  ', $countPlans);

}
public static function getAllPlanOrders(){
        $planOrders=PlanOrder::orderBy('created_at', 'DESC')->get();
        return jsonTrait::jsonResponse(200, 'All plan orders  ', $planOrders);

    }

    public static function showPlanOrder($id){
        $planOrder=PlanOrder::findOrfail($id);
       return jsonTrait::jsonResponse(200, ' plan orders  ', $planOrder);
    }
//doctors

public static function getPlanOrders(){
    $id=auth()->user()->id;
    $planOrders=PlanOrder::where('doctor_id',$id)->orderBy('created_at', 'DESC')->get();
    return jsonTrait::jsonResponse(200, 'All plan orders  ', $planOrders);

}

public static function countPlanOrders(){
    $id=auth()->user()->id;
    $planOrders=PlanOrder::where('doctor_id',$id)->count();
    return jsonTrait::jsonResponse(200, 'All plan orders  ', $planOrders);

}
//for doctor to add price to this planOrder
public static function addPrice(Request $request,$planOrder_id){

    $planOrder=PlanOrder::findOrFail($planOrder_id);
    $price=$planOrder->price=$request->price;
    $planOrder->save();
    return jsonTrait::jsonResponse(200, ' price of plan', $price);

}



//for patient to paid for this plan order

public static function paid($planOrder_id,Request $request){
   $user_id=auth()->user()->id;
    $bill=Bill::create([
        'planOrder_id'=>$planOrder_id,
        'user_id'=>$user_id,
        'payment_method'=>$request->payment_method,

    ]);
    $planOrder=PlanOrder::findOrFail($planOrder_id);
     // Check if the plan order is already paid
     if ($planOrder->isPaid) {
        return jsonTrait::jsonResponse(400, 'This plan order is already paid');
    }

    $planOrder->isPaid=1;
    $planOrder->save();
    return jsonTrait::jsonResponse(200, 'done paid successfully', );

}


//patient
public static function myOrdersPlans(){
    $id=auth()->user()->id;
    $planOrders=PlanOrder::where('patient_id',$id)->get();
    return jsonTrait::jsonResponse(200, 'my plan orders',$planOrders );

}


public static function storePlanOrder(Request $request){
$patient_id=auth()->user()->id;
    $planOrder=PlanOrder::create([
    'description'         =>$request->description,
    'goals'               =>$request->goals,
    'patient_id'          =>$patient_id,
    'doctor_id'           =>$request->doctor_id,
     ]);

    return jsonTrait::jsonResponse(200,'store plan order ',$planOrder);

  }

  public static function updatePlanOrder(Request $request,$id){
        $planOrder=PlanOrder::findOrfail($id);
        $planOrder->update([
        'description'         =>$request->description,
        'goals'               =>$request->goals,
        'doctor_id'           =>$request->doctor_id,
         ]);

        return jsonTrait::jsonResponse(200,'update plan order ',$planOrder);

      }
}
