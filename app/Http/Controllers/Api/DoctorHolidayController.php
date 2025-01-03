<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DoctorHolidayService;

class DoctorHolidayController extends Controller
{
    public  function index()
    {
        $result = DoctorHolidayService::index();

        return response()->json(['message' => $result]);
    }
    public  function doctorHolidays($doc_id)
    {
        $result = DoctorHolidayService::doctorHolidays($doc_id);

        return response()->json(['message' => $result]);
    }

    public  function myHolidays()
    {
        $result = DoctorHolidayService::myHolidays();

        return response()->json(['message' => $result]);
    }
    public  function storeHoliday(Request $request)
    {
        $result = DoctorHolidayService::storeHoliday($request);

        return response()->json(['message' => $result]);
    }
    public  function updateHoliday(Request $request,$id)
    {
        $result = DoctorHolidayService::updateHoliday($request,$id);

        return response()->json(['message' => $result]);
    }

    public  function deleteHoliday($id)
    {
        $result = DoctorHolidayService::deleteHoliday($id);

        return response()->json(['message' => $result]);
    }
}
