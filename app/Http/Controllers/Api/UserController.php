<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\userService;
use App\Http\Traits\jsonTrait;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

//admin
public  function countUser(){
    $result = userService::countUser();

    return response()->json(['message' => $result]);

}
    public function getAllDoctors(Request $request)
    {

        $result = userService::getAllDoctors($request);


        return response()->json(['message' => $result]);
    }

    public function getDoctor($id)
    {

        $result = userService::getDoctor($id);


        return response()->json(['message' => $result]);
    }

    public function getDoctorWithPatients($id)
    {

        $result = userService::getDoctorWithPatients($id);


        return response()->json(['message' => $result]);
    }

    public function softDelete($id)
    {
        $user=User::findOrfail($id);
        $result = userService::softDelete($user);


        return response()->json(['message' => $result]);
    }

    public function deletedUsers()
    {
        $result = userService::deletedUsers();


        return response()->json(['message' => $result]);
    }
    public function restore($id)
    {
        $result = userService::restore($id);


        return response()->json(['message' => $result]);
    }

    public function getAllPatient(Request $request)
    {
        $result = userService::getAllPatient($request);


        return response()->json(['message' => $result]);
    }
    public function isAgreeDoctor(Request $request,$id)
    {
        $result = userService::isAgreeDoctor($id,$request);

        return response()->json(['message' => $result]);
    }
    public function allPendingDoctors()
    {
        $result = userService::allPendingDoctors();

        return response()->json(['message' => $result]);
    }


}
