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

    public  function showMyBills()
    {
        $result = monthBillsService::showMyBills();

        return response()->json(['message' => $result]);
    }
    public  function countMyBills()
    {
        $result = monthBillsService::countMyBills();

        return response()->json(['message' => $result]);
    }


    public  function countPaidBills()
    {
        $result = monthBillsService::countPaidBills();

        return response()->json(['message' => $result]);
    }

    public  function unPaidBills()
    {
        $result = monthBillsService::unPaidBills();

        return response()->json(['message' => $result]);
    }

    public  function paidBill($id)
    {
        $result = monthBillsService::paidBill($id);

        return response()->json(['message' => $result]);
    }

    
}
