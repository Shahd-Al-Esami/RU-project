<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\FollowService;
use App\Http\Controllers\Controller;

class FollowController extends Controller
{
    //doctor
    public  function getfollows()
    {
        $result = FollowService::getfollows();

        return response()->json(['message' => $result]);
    }

    public  function countfollows()
    {
        $result = FollowService::countfollows();

        return response()->json(['message' => $result]);
    }
//patient
    public  function followDoctor($doctor_id)
    {
        $result = FollowService::followDoctor( $doctor_id);

    // Check for result and set success or error messages
        // return session()->flash('success', 'Successfully followed the doctor.');
        return redirect()->back();



     }

    public  function disfollowDoctor($doctor_id)
    {
        $result = FollowService::disfollowDoctor( $doctor_id);

        return redirect()->back();
    }

    public  function myFollowers()
    {
        $followers = FollowService::myFollowers();

       return view('patient.myFollowers',['followers'=>$followers]);
    }
}
