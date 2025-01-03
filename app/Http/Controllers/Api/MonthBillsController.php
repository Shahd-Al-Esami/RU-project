<?php

namespace App\Http\Controllers\Api;


use App\Http\Traits\jsonTrait;
use App\Services\MonthBillsService;
use App\Http\Controllers\Controller;


class MonthBillsController extends Controller
{
    use jsonTrait;


public  function countMonthBills()
    {
        $result = MonthBillsService::countMonthBills();

        return response()->json(['message' => $result]);
    }

    public  function showMyBills()
    {
        $result = MonthBillsService::showMyBills();

        return response()->json(['message' => $result]);
    }
    public  function countMyBills()
    {
        $result = MonthBillsService::countMyBills();

        return response()->json(['message' => $result]);
    }


    public  function countPaidBills()
    {
        $result = MonthBillsService::countPaidBills();

        return response()->json(['message' => $result]);
    }

    public  function unPaidBills()
    {
        $result = MonthBillsService::unPaidBills();

        return response()->json(['message' => $result]);
    }

    public  function paidBill($id)
    {
        $result = MonthBillsService::paidBill($id);

        return response()->json(['message' => $result]);
    }


}
