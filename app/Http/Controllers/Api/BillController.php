<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Http\Controllers\Controller;
use App\Services\BillService;

class BillController extends Controller

{ use jsonTrait;
//admin
    public  function AllmonthBills(Request $request)
    {
        $bills = BillService::AllmonthBills($request);

return view('admin.bills',['bills'=>$bills]);
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


//doctor

public  function planBills()
{
    $bills = BillService::planBills();

return view('doctor.bills',['bills'=>$bills]);
}

}
