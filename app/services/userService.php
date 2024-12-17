<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;

class userService
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





     public static function getAllDoctors(Request $request){

        $search=$request->input('search');

        if($search){

            $doctors=User::where('role','doctor')->where('name', 'LIKE', '%' . $search . '%')->with( 'doctorInformation')->get();
        }else{
        $doctors=User::where('role','doctor')->with( 'doctorInformation')->get();
        }
      return jsonTrait::jsonResponse(200, 'doctors with their information', $doctors);

    }





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
    $patients=User::where('role','patient')->where('name', 'LIKE', '%' . $search . '%')->with( 'PatientInformation')->get();
    }
    $patients=User::where('role','patient')->with( 'PatientInformation')->get();

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


}
