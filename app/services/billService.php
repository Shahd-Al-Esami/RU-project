<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\User;
use App\Models\PlanOrder;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;

class BillService
{

use jsonTrait;
//admin
    public static function AllmonthBills(Request $request)
{
    $doctorId = $request->input('doctor_id'); // معرف الطبيب
    $date = $request->input('date');        // الشهر

    $query = PlanOrder::query();


        // تصفية حسب تاريخ الفواتير (created_at)
        if ($date && $doctorId) {
            $query->where('doctor_id', $doctorId);

            return $bills = $query->with('bill')
            ->whereDate('created_at', '=',$date)->get();

        }

    // تصفية بواسطة معرف الطبيب إذا وجد
    if ($doctorId) {
        $query->where('doctor_id', $doctorId);
     return $bills = $query->with('bill')->orderBy('created_at','desc')->get();

    }



    // جلب البيانات مع الفواتير

    $bills =PlanOrder::orderBy('created_at','desc')->get();
    return $bills;
}

//doctor


public static function planBills(){
    $id=auth()->user()->id;
    $bills=PlanOrder::where('doctor_id',$id)->with('bill')->get();
return $bills;
}

public static function patientBills($id){
    $bills=Bill::where('user_id',$id)->with('planOrder')->get();
   return jsonTrait::jsonResponse(200,'All Bills of patient',$bills);

}
//patient

public static function myBills(){
    $id=auth()->user()->id;
    $bills=Bill::where('user_id',$id)->with('planOrder')->get();
   return jsonTrait::jsonResponse(200,'All Bills of patient',$bills);

}

}
