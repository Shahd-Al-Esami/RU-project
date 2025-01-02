<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\appointmentService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public  function getAvailable($doctor_id,$day,$date)
    {
        $result = appointmentService::getAvailable($doctor_id,$day,$date);

        return response()->json(['message' => $result]);
    }
    public  function bookAppointment(Request $request)
    {
        $result = appointmentService::bookAppointment($request);

        return response()->json(['message' => $result]);
    }
    public  function getAppointments(Request $request)
    {
        $result = appointmentService::getAppointments($request);

        return response()->json(['message' => $result]);
    }
    public  function myAppointments()
    {
        $result = appointmentService::myAppointments();

        return response()->json(['message' => $result]);
    }

}
