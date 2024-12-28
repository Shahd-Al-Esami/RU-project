<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\reportService;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public  function storeReport(Request $request,$patient_id,$plan_id)
    {
        $result = reportService::storeReport($request,$patient_id,$plan_id);

        return response()->json(['message' => $result]);
    }

    public  function updateReport(Request $request,$id,$patient_id,$plan_id)
    {
        $result = reportService::updateReport($request,$id,$patient_id,$plan_id);

        return response()->json(['message' => $result]);
    }

    public  function deleteReport($id)
    {
        $result = reportService::deleteReport($id);

        return response()->json(['message' => $result]);
    }

    public  function myReports()
    {
        $result = reportService::myReports();

        return response()->json(['message' => $result]);
    }

    public  function patientReports($id)
    {
        $result = reportService::patientReports($id);

        return response()->json(['message' => $result]);
    }
    public  function getAllreports()
    {
        $result = reportService::getAllreports();

        return response()->json(['message' => $result]);
    }


    public  function allreportsOfDoctor($id)
    {
        $result = reportService::allreportsOfDoctor($id);

        return response()->json(['message' => $result]);
    }

}
