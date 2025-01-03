<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DoctorInformation;
use App\Http\Controllers\Controller;
use App\Services\DoctorInformationService;

class DoctorInformationController extends Controller
{
    public  function myProfile()
    {
        $result = DoctorInformationService::myProfile();

        return response()->json(['message' => $result]);
    }
    public  function updateProfile(Request $request)
    {
        $result = DoctorInformationService::updateProfile($request);

        return response()->json(['message' => $result]);
    }

    public  function store(Request $request)
    {
        $result = DoctorInformationService::store( $request);

        return response()->json(['message' => $result]);
    }

    public  function doctorProfile($id)
    {
        $result = DoctorInformationService::doctorProfile($id);

        return response()->json(['message' => $result]);
    }
}
