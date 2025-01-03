<?php

namespace App\Services;

use App\Models\MonthBills;

use App\Http\Traits\jsonTrait;

class MonthBillsService
{

use jsonTrait;
//admin
public static function countMonthBills()//فواتير الاطباء للادمن
    {
      $bills=MonthBills::all();
     $countBills=count($bills);
    return jsonTrait::jsonResponse(200,'Bill for Admin',$countBills);

    }

    //doctor
    public static function showMyBills()
    {
        $id=auth()->user()->id;
        $monthBills=MonthBills::where('user_id',$id)->get();
    return jsonTrait::jsonResponse(200,'all my monthBills',$monthBills);

    }

    public static function countMyBills()
    {
        $id=auth()->user()->id;
        $monthBills=MonthBills::where('user_id',$id)->count();
    return jsonTrait::jsonResponse(200,'count my monthBills',$monthBills);

    }

    public static function countPaidBills()
    {
        $id=auth()->user()->id;
        $countPaidBills=MonthBills::where('user_id',$id)->where('isPaid',1)->count();
    return jsonTrait::jsonResponse(200,' countPaidBills',$countPaidBills);

    }

   public static function unPaidBills()
    {
        $id=auth()->user()->id;
        $unPaidBills=MonthBills::where('user_id',$id)->where('isPaid', 0)->get();
    return jsonTrait::jsonResponse(200,' unPaidBills',$unPaidBills);

    }

    public static function paidBill($id)
    {
        $monthBill=MonthBills::findOrFail($id);
          // Check if the plan order is already paid
     if ($monthBill->isPaid) {
        return jsonTrait::jsonResponse(400, 'This bill is already paid');
    }
        $monthBill->isPaid=1;
        $monthBill->save();
    return jsonTrait::jsonResponse(200,' done paid ',);

    }


}
