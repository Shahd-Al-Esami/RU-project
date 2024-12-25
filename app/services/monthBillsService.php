<?php

namespace App\Services;

use App\Models\MonthBills;

use App\Http\Traits\jsonTrait;

class monthBillsService
{

use jsonTrait;

public static function countMonthBills()//فواتير الطبيب للادمن
    {
   $bills=MonthBills::all();
     $countBills=count($bills);
    return jsonTrait::jsonResponse(200,'Bill for Admin',$countBills);

    }
}
