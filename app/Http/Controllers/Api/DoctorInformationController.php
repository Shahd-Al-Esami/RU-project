<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DoctorInformation;
use App\Http\Controllers\Controller;
use App\Services\doctorInformationService;

class DoctorInformationController extends Controller
{
    public  function myProfile()
    {
        $result = doctorInformationService::myProfile();

        return response()->json(['message' => $result]);
    }
    public  function updateProfile(Request $request)
    {
        $result = doctorInformationService::updateProfile( $request,);

        return response()->json(['message' => $result]);
    }

    public  function store(Request $request)
    {
        $result = doctorInformationService::store( $request);

        return response()->json(['message' => $result]);
    }
}
