<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Http\Controllers\Controller;
use App\Services\BillService;

class BillController extends Controller
{ use jsonTrait;
//admin
    public  function monthBills(Request $request)
    {
        $result = BillService::monthBills($request);

        return response()->json(['message' => $result]);
    }
    public  function patientBills($id)
    {
        $result = BillService::patientBills($id);

        return response()->json(['message' => $result]);
    }

    public  function myBills()
    {
        $result = BillService::myBills();

        return response()->json(['message' => $result]);
    }




}
