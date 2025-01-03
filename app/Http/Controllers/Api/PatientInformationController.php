<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\patientInformationService;
use App\Http\Requests\PatientInformationRequest;

class PatientInformationController extends Controller
{
    public  function myProfile()
    {
        $result = patientInformationService::myProfile();

        return response()->json(['message' => $result]);
    }
    public  function updateProfile(Request $request)
    {
        $result = patientInformationService::updateProfile($request,);

        return response()->json(['message' => $result]);
    }

    public  function store(PatientInformationRequest $request)
    {
        $result = patientInformationService::store($request);

        return response()->json(['message' => $result]);
    }

}
