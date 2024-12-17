<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\Plan;
use App\Models\User;
use App\Models\PlanOrder;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;

class billService
{

use jsonTrait;
//admin
public static function monthBills(Request $request)//to filter bills by year and month
    {
        $month=$request->input('month');
        $year=$request->input('year');

        if($month && $year)
        {
            $bills = Bill::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();
       return jsonTrait::jsonResponse(200, 'All Bills in this date', $bills);

        }
        $bills =Bill::orderBy('created_at','desc')->get();

       return jsonTrait::jsonResponse(200, 'All Bills', $bills);
    }

    public static function patientBills($id){
        $bills=User::where('id',$id)->with('bills')->get();
        return jsonTrait::jsonResponse(200,'All Bills of patient',$bills);

    }
   public static function addBillToDoctor($doctor_id) //doctorBill to admin
   {
    $price=PlanOrder::where('doctor_id',$doctor_id)->select('price')->get();
     $total=$price->sum('price');
     $bill=40 * $total /100;
    return jsonTrait::jsonResponse(200,'Bill for Admin',$bill);


    }
    public static function countBills(){
   $bills=Bill::all();
     $countBills=count($bills);
    return jsonTrait::jsonResponse(200,'Bill for Admin',$countBills);

    }

}
