<?php
namespace App\Services;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;

class reportService
{

use jsonTrait;
//doctor
public static function storeReport(Request $request){
    $report=Report::create([
        'title' => $request->title,
        'description' => $request->description,
        'filePath' => $request->filePath,
        'date' => $request->date,
        'recommended' => $request->recommended,
        'monthReport_id' => $request->monthReport_id,
        'plan_id' => $request->plan_id,
        'patient_id' => $request->patient_id,
        'doctor_id' => $request->doctor_id,
]);
return jsonTrait::jsonResponse(200, 'add report successfully', $report);

}
public static function updateReport(Request $request,Report $report){
    $report->update([
        'title' => $request->title,
        'description' => $request->description,
        'filePath' => $request->filePath,
        'date' => $request->date,
        'recommended' => $request->recommended,
        'monthReport_id' => $request->monthReport_id,
        'plan_id' => $request->plan_id,
        'patient_id' => $request->patient_id,
        'doctor_id' => $request->doctor_id,
]);
  return jsonTrait::jsonResponse(200, 'update report successfully', $report);

}
public static function deleteReport(Report $report){
$report->delete();
 return jsonTrait::jsonResponse(200, 'delete report successfully', null);


}
//admin
public static function allreportsOfDoctor($id){

    $reports=Report::where('doctor_id',$id)->get();
 return jsonTrait::jsonResponse(200, 'all reports of this doctor', $reports);

}

public static function getAllreports(){
$reports=Report::paginate(5);
return jsonTrait::jsonResponse(200, 'all reports', $reports);


}


}
