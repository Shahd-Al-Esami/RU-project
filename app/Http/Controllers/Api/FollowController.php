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

        return response()->json(['message' => $result]);
    }

    public  function disfollowDoctor($doctor_id)
    {
        $result = FollowService::disfollowDoctor( $doctor_id);

        return response()->json(['message' => $result]);
    }

    public  function myFollowers()
    {
        $result = FollowService::myFollowers();

        return response()->json(['message' => $result]);
    }
}
