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



//doctor



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
