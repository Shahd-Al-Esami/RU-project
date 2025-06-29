<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Traits\jsonTrait;
use App\Http\Controllers\Controller;
use App\Services\BlockedUserService;

class UserController extends Controller
{

//admin

public  function addUser(){

return view('admin.register');
}

//patient
    public function getAllDoctors(Request $request)
    {

        $doctors = UserService::getAllDoctors($request);


return view('patient.allDoctors',compact('doctors'));
    }

//admin
    public function getDoctors(Request $request)
    {

        $doctors = UserService::getDoctors($request);


return view('admin.doctors',compact('doctors'));
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


        return redirect()->back();
    }


    public function restore($id)
    {
        $result = UserService::restore($id);


        return redirect()->back();
    }

    public  function blockUser($id,Request $request)
    {

        $result = BlockedUserService::blockUser($id,$request);

        return redirect()->back();
    }
    public  function disblockUser($id)
    {
        $result = BlockedUserService::disblockUser($id);

        return redirect()->back();
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


    public function getAllPatient(Request $request)
    {
        $patients = UserService::getAllPatient($request);


        return view('admin.patients',['patients'=>$patients]) ;
    }
    public function isAgreeDoctor($id)
    {
        $result = UserService::isAgreeDoctor($id);

        return redirect()->route('allPendingDoctors');
    }
    public function allPendingDoctors()
    {
        $doctors = UserService::allPendingDoctors();

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
