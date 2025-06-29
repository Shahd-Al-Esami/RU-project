<?php

namespace App\Http\Controllers\Api;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Services\ReportService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;

class ReportController extends Controller
{

    public  function addReport()
    {

return view('doctor.addReport');
    }
    public  function editReport($report_id)
    {
      $report=Report::findOrfail($report_id);
return view('doctor.addReport',['report'=>$report]);
    }


    public  function storeReport(ReportRequest $request)
    {
        $report = ReportService::storeReport($request);

        return redirect()->route('getReports');
 }

    public  function updateReport(ReportRequest $request,$id,$patient_id)
    {
        $result = ReportService::updateReport($request,$id,$patient_id);

        return redirect()->route('getReports');
    }

    public  function deleteReport($id)
    {
        $result = ReportService::deleteReport($id);

        return response()->json(['message' => $result]);
    }

    public  function myReports()
    {
        $reports = ReportService::myReports();

return view('patient.myReports',['reports'=>$reports]);
    }

    public  function patientReports($id)
    {
        $result = ReportService::patientReports($id);

        return response()->json(['message' => $result]);
    }
    public  function getAllreports(Request $request)
    {
        $reports = ReportService::getAllreports($request);

return view('admin.reports',['reports'=>$reports]);
    }


    public  function allreportsOfDoctor($id)
    {
        $result = ReportService::allreportsOfDoctor($id);

        return response()->json(['message' => $result]);
    }
    public  function getReports(Request $request)
    {
        $reports = ReportService::getReports($request);

return view('doctor.reports',['reports'=>$reports]);
    }

}
