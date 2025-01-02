<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\doctorHolidayService;

class DoctorHolidayController extends Controller
{
    public  function index()
    {
        $result = doctorHolidayService::index();

        return response()->json(['message' => $result]);
    }
    public  function doctorHolidays($doc_id)
    {
        $result = doctorHolidayService::doctorHolidays($doc_id);

        return response()->json(['message' => $result]);
    }

    public  function myHolidays()
    {
        $result = doctorHolidayService::myHolidays();

        return response()->json(['message' => $result]);
    }
    public  function storeHoliday(Request $request)
    {
        $result = doctorHolidayService::storeHoliday($request);

        return response()->json(['message' => $result]);
    }
    public  function updateHoliday(Request $request,$id)
    {
        $result = doctorHolidayService::updateHoliday($request,$id);

        return response()->json(['message' => $result]);
    }

    public  function deleteHoliday($id)
    {
        $result = doctorHolidayService::deleteHoliday($id);

        return response()->json(['message' => $result]);
    }
}
