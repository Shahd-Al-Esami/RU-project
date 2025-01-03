<?php
namespace App\Services;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Http\Requests\ReportRequest;

class ReportService
{

use jsonTrait;
//doctor
public static function storeReport(ReportRequest $request,$patient_id,$plan_id){
    $id=auth()->user()->id;
    $report=Report::create([
        'title'       => $request->title,
        'description' => $request->description,
        'date'        => $request->date,
        'recommended' => $request->recommended,
        'plan_id'     => $plan_id,
        'patient_id'  => $patient_id,
        'doctor_id'   => $id,
]);
return jsonTrait::jsonResponse(200, 'add report successfully', $report);

}
public static function updateReport(ReportRequest $request,$id,$plan_id,$patient_id){
    $doctor_id=auth()->user()->id;
    $report=Report::findOrFail($id);
    $report->update([
        'title'       => $request->title,
        'description' => $request->description,
        'date'        => $request->date,
        'recommended' => $request->recommended,
        'plan_id'     => $plan_id,
        'patient_id'  => $patient_id,
        'doctor_id'   => $doctor_id,
]);
  return jsonTrait::jsonResponse(200, 'update report successfully', $report);

}
public static function deleteReport($id){
    $report=Report::findOrFail($id);
    $report->delete();
 return jsonTrait::jsonResponse(200, 'delete report successfully', null);


}
public static function myReports(){
$id=auth()->user()->id;
    $reports=Report::where('doctor_id',$id)->paginate(5);
 return jsonTrait::jsonResponse(200, 'my reports', $reports);

}
public static function patientReports($id){
    $doc_id=auth()->user()->id;
    $reports=Report::where('doctor_id',$doc_id)->where('patient_id',$id)->get();
 return jsonTrait::jsonResponse(200, 'all reports of this patient', $reports);

}


//admin
public static function allreportsOfDoctor($id){

    $reports=Report::where('doctor_id',$id)->paginate(5);
 return jsonTrait::jsonResponse(200, 'all reports of this doctor', $reports);

}

public static function getAllreports(){
$reports=Report::paginate(5);
return jsonTrait::jsonResponse(200, 'all reports', $reports);

}




}
