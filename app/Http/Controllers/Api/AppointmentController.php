<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AppointmentService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public  function getAvailable($doctor_id,$day,$date)
    {
        $result = AppointmentService::getAvailable($doctor_id,$day,$date);

        return response()->json(['message' => $result]);
    }
    public  function bookAppointment(Request $request)
    {
        $result = AppointmentService::bookAppointment($request);

        return response()->json(['message' => $result]);
    }
    public  function getAppointments(Request $request)
    {
        $result = AppointmentService::getAppointments($request);

        return response()->json(['message' => $result]);
    }
    public  function myAppointments()
    {
        $result = AppointmentService::myAppointments();

        return response()->json(['message' => $result]);
    }

}
