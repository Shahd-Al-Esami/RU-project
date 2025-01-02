<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\followService;
use App\Http\Controllers\Controller;

class FollowController extends Controller
{
    //doctor
    public  function getfollows()
    {
        $result = followService::getfollows();

        return response()->json(['message' => $result]);
    }
 
    public  function countfollows()
    {
        $result = followService::countfollows();

        return response()->json(['message' => $result]);
    }
//patient
    public  function followDoctor($doctor_id)
    {
        $result = followService::followDoctor( $doctor_id);

        return response()->json(['message' => $result]);
    }

    public  function disfollowDoctor($doctor_id)
    {
        $result = followService::disfollowDoctor( $doctor_id);

        return response()->json(['message' => $result]);
    }

    public  function myFollowers()
    {
        $result = followService::myFollowers();

        return response()->json(['message' => $result]);
    }
}
