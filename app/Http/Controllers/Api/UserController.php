<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Traits\jsonTrait;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

//admin
// public  function countUser(){
//     $result = UserService::countUser();

//     return response()->json(['message' => $result]);

// }
    public function getAllDoctors(Request $request)
    {

        $doctors = UserService::getAllDoctors($request);


return view('patient.allDoctors',compact('doctors'));
    }

    public function getDoctor($id)
    {

        $result = UserService::getDoctor($id);


        return response()->json(['message' => $result]);
    }

    public function getDoctorWithPatients($id)
    {

        $result = UserService::getDoctorWithPatients($id);


        return response()->json(['message' => $result]);
    }

    public function softDelete($id)
    {
        $user=User::findOrfail($id);
        $result = UserService::softDelete($user);


        return response()->json(['message' => $result]);
    }

    public function softDeleteMe()//الغاء تنشيط
    {

        $result = UserService::softDeleteMe();


        return response()->json(['message' => $result]);
    }

    public function deletedUsers()
    {
        $result = UserService::deletedUsers();


        return response()->json(['message' => $result]);
    }
    public function restore($id)
    {
        $result = UserService::restore($id);


        return response()->json(['message' => $result]);
    }

    public function getAllPatient(Request $request)
    {
        $result = UserService::getAllPatient($request);


        return response()->json(['message' => $result]);
    }
    public function isAgreeDoctor($id)
    {
        $result = UserService::isAgreeDoctor($id);

        return redirect()->route('allPendingDoctors');
    }
    public function allPendingDoctors(Request $request)
    {
        $doctors = UserService::allPendingDoctors($request);

return view('admin.doctors',['doctors'=>$doctors]) ;   }

    //doctor

  public function myPatients()
    {
        $patients = UserService::myPatients();

return view('doctor.myPatients',['patients'=>$patients] );   }


  public function getPatientWithInfo($id)
  {
      $result = UserService::getPatientWithInfo($id);

      return response()->json(['message' => $result]);
  }
}
