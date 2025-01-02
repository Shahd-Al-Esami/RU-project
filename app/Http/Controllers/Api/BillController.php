<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Http\Controllers\Controller;
use App\Services\billService;

class BillController extends Controller
{ use jsonTrait;
//admin
    public  function monthBills(Request $request)
    {
        $result = billService::monthBills($request);

        return response()->json(['message' => $result]);
    }
    public  function patientBills($id)
    {
        $result = billService::patientBills($id);

        return response()->json(['message' => $result]);
    }
   
    public  function myBills()
    {
        $result = billService::myBills();

        return response()->json(['message' => $result]);
    }

 


}
