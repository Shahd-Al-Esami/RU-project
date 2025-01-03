<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PatientInformationService;
use App\Http\Requests\PatientInformationRequest;

class PatientInformationController extends Controller
{
    public  function myProfile()
    {
        $result = PatientInformationService::myProfile();

        return response()->json(['message' => $result]);
    }
    public  function updateProfile(Request $request)
    {
        $result = PatientInformationService::updateProfile($request,);

        return response()->json(['message' => $result]);
    }

    public  function store(PatientInformationRequest $request)
    {
        $result = PatientInformationService::store($request);

        return response()->json(['message' => $result]);
    }

}
