<?php

namespace App\Http\Controllers\Api;


use App\Http\Traits\jsonTrait;
use App\Services\monthBillsService;
use App\Http\Controllers\Controller;


class MonthBillsController extends Controller
{
    use jsonTrait;


public  function countMonthBills()
    {
        $result = monthBillsService::countMonthBills();

        return response()->json(['message' => $result]);
    }
}
