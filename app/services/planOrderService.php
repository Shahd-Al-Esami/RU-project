<?php

namespace App\Services;

use App\Models\PlanOrder;
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



}
