<?php
namespace App\Services;

use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Http\Requests\ReportRequest;

class ReportService
{

use jsonTrait;
//doctor
public static function storeReport(ReportRequest $request){
    $id=auth()->user()->id;
    $report=Report::create([
        'title'       => $request->title,
        'description' => $request->description,
        'date'        => $request->date,
        'recommended' => $request->recommended,
        // 'plan_id'     => $plan_id,
        'patient_id'  => $request->patient_id,
        'doctor_id'   => $id,
]);
return $report;
}
public static function updateReport(ReportRequest $request,$id,$patient_id){
    $doctor_id=auth()->user()->id;
    $report=Report::findOrFail($id);
    $report->update([
        'title'       => $request->title,
        'description' => $request->description,
        'date'        => $request->date,
        'recommended' => $request->recommended,
        // 'plan_id'     => $plan_id,
        'patient_id'  => $patient_id,
        'doctor_id'   => $doctor_id,
]);
return $report;
}
public static function deleteReport($id){
    $report=Report::findOrFail($id);
    $report->delete();
 return jsonTrait::jsonResponse(200, 'delete report successfully', null);


}
public static function myReports(){
$id=auth()->user()->id;
    $reports=Report::where('patient_id',$id)->get();
return $reports;

}
public static function patientReports($id){
    $doc_id=auth()->user()->id;
    $reports=Report::where('doctor_id',$doc_id)->where('patient_id',$id)->get();
 return jsonTrait::jsonResponse(200, 'all reports of this patient', $reports);

}

public static function getReports(Request $request)
{
    $search = $request->input('search');
    $doc_id = auth()->user()->id;

    // Get all patient IDs for the current doctor
    $patient_ids_query = Report::where('doctor_id', $doc_id)->pluck('patient_id');

    if ($search) {
        // Find patients matching the search
        $patient_ids = User::whereIn('id', $patient_ids_query)
            ->where('name', 'LIKE', '%' . $search . '%')
            ->pluck('id');

        // Fetch reports for these patients
        $reports = Report::whereIn('patient_id', $patient_ids)->get();
    } else {
        // Fetch all reports for the doctor
        $reports = Report::where('doctor_id', $doc_id)->get();
    }

    return $reports;
}

//admin
public static function allreportsOfDoctor($id){

    $reports=Report::where('doctor_id',$id)->paginate(5);
 return jsonTrait::jsonResponse(200, 'all reports of this doctor', $reports);

}

public static function getAllReports(Request $request)
{
    $search = $request->input('search');

    // Get all patient IDs (for the current doctor context, you may need to filter further if applicable)
    $patient_ids_query = Report::pluck('patient_id');

    if ($search) {
        // Find patients matching the search name
        $patient_ids = User::whereIn('id', $patient_ids_query)
            ->where('name', 'LIKE', '%' . $search . '%')
            ->pluck('id');

        // Fetch reports for these patients
        $reports = Report::whereIn('patient_id', $patient_ids)->get();
    } else {
        // Fetch all reports ordered by date
        $reports = Report::orderBy('date', 'DESC')->get();
    }

    // Return reports as JSON response
return $reports;
}


}
