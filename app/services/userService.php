<?php

namespace App\Services;

use App\Models\User;
use App\Models\PlanOrder;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;

class UserService
{

use jsonTrait;

//admin
public static function countUser(){

$allUser=User::all();
$countUser=count($allUser);

    return jsonTrait::jsonResponse(200, 'doctor with details', $countUser);
}
public static function getDoctor($id){

    $doctor = User::where('id', $id)->with('doctorInformation')->firstOrFail();


    return jsonTrait::jsonResponse(200, 'doctor with details', $doctor);
}




// patient+admin
     public static function getAllDoctors(Request $request){

        $search=$request->input('search');

        if($search){

        $doctors=User::where('role','doctor')->where('isAgreeDoctorRegistration','agree')->where('name', 'LIKE', '%' . $search . '%')->get();
        }else{
        $doctors=User::where('role','doctor')->where('isAgreeDoctorRegistration','agree')->get();
        }
      return jsonTrait::jsonResponse(200, 'doctors with their information', $doctors);

    }

//admin
    public static function getDoctorWithPatients($id){
        $doctor = User::findOrFail($id);
        $hisPatients = $doctor->planOrders->pluck('patient_id');
        $patients = User::whereIn('id', $hisPatients)->get();
        return jsonTrait::jsonResponse(200, 'doctor with his Patients', $patients);
    }



    public static function softDelete(User $user){
         $user->delete();
          return jsonTrait::jsonResponse(204, 'deleted successfuly', null);

    }
    public static function deletedUsers(){
        $deletedUsers=User::onlyTrashed()->get();
        return jsonTrait::jsonResponse(200, 'deleted Users', $deletedUsers);
    }

public static function restore($id) {

    $deletedUser = User::withTrashed()->findOrFail($id);
    $deletedUser->restore();

    return jsonTrait::jsonResponse(200, 'restored successfully', $deletedUser);
}


public static function getAllPatient(Request $request){

    $search=$request->input('search');

    if($search){
    $patients=User::where('role','patient')->where('name', 'LIKE', '%' . $search . '%')->get();
    }
    $patients=User::where('role','patient')->get();

    return jsonTrait::jsonResponse(200, 'restored successfuly', $patients);

}
public static function isAgreeDoctor($id,Request $request){
$doctor=User::findOrfail($id);
$doctor->isAgreeDoctorRegistration=$request->isAgreeDoctorRegistration;
$doctor->save();
return jsonTrait::jsonResponse(200, 'Accepted doctors', $doctor);


}


public static function allPendingDoctors() {
    // Fetch all pending doctors
    $pendingDoctors = User::where('role', 'doctor')->where('isAgreeDoctorRegistration','LIKE', 'pending')->get();

    return jsonTrait::jsonResponse(200, 'Pending doctors', $pendingDoctors);
}

//doctors


public static function myPatients(){
    $id = auth()->user()->id;
    $myPatientsIds = PlanOrder::where('doctor_id', $id)->pluck('patient_id')->all();

    $patients = User::whereIn('id', $myPatientsIds)->get();

    return jsonTrait::jsonResponse(200, 'doctor patients', $patients);
}
public static function getPatientWithInfo($id){

    $patient = User::where('id', $id)->with('patientInformation')->firstOrFail();


    return jsonTrait::jsonResponse(200, 'patient with details', $patient);
}

//patient+admin +doctor
public static function softDeleteMe()//الغاء تنشيط حسابي
{
    $id=auth()->user()->id;
    $user=User::findOrfail($id);
    $token = $user->currentAccessToken();
    if ($token) {
        $token->delete();
    }
    $user->delete();


    return jsonTrait::jsonResponse(200, ' Deleted successfully and logout', null);
}




}
