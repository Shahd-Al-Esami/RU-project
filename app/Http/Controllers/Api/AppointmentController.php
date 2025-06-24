<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AppointmentService;

class AppointmentController extends Controller
{
    public  function getAvailable(Request $request)
    {



        $availableTimes= AppointmentService::getAvailable( $request);
        $doctor=User::findOrfail($request->doctor_id);

        return view('appointments.available', [
            'doctor_id' => $request->doctor_id,
            'doctor' => $doctor,
            'date' => $request->date,
             'availableTimes' => $availableTimes,
        ]);    }


    public  function bookAppointment(Request $request)
    {
        // dd($request);
         AppointmentService::bookAppointment($request);

        return  redirect()->route('home');

    }
    public  function getAppointments(Request $request)
    {
        return AppointmentService::getAppointments($request);

    }
    public  function myAppointments()
    {
        return $result = AppointmentService::myAppointments();

    }


    public  function cancelStatus(Request $request,$id)
    {
        return $result = AppointmentService::cancelStatus($request,$id);

    }
    public  function doneStatus(Request $request,$id)
    {
        return $result = AppointmentService::doneStatus($request,$id);

    }

}
