<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\ReportService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;

class ReportController extends Controller
{
    public  function storeReport(ReportRequest $request,$patient_id,$plan_id)
    {
        $result = ReportService::storeReport($request,$patient_id,$plan_id);

        return response()->json(['message' => $result]);
    }

    public  function updateReport(ReportRequest $request,$id,$patient_id,$plan_id)
    {
        $result = ReportService::updateReport($request,$id,$patient_id,$plan_id);

        return response()->json(['message' => $result]);
    }

    public  function deleteReport($id)
    {
        $result = ReportService::deleteReport($id);

        return response()->json(['message' => $result]);
    }

    public  function myReports()
    {
        $result = ReportService::myReports();

        return response()->json(['message' => $result]);
    }

    public  function patientReports($id)
    {
        $result = ReportService::patientReports($id);

        return response()->json(['message' => $result]);
    }
    public  function getAllreports()
    {
        $result = ReportService::getAllreports();

        return response()->json(['message' => $result]);
    }


    public  function allreportsOfDoctor($id)
    {
        $result = ReportService::allreportsOfDoctor($id);

        return response()->json(['message' => $result]);
    }

}
