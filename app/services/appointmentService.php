<?php

namespace App\Services;


use Carbon\Carbon;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;

class appointmentService
{

use jsonTrait;

//patient
public static function getAvailable($doctor_id, $day, $date) {
    $doctor = User::findOrFail($doctor_id);

    foreach ($doctor->doctorHoliday as $holiday) {
        if ($day == $holiday->day) {
            return jsonTrait::jsonResponse(400, 'This day is a holiday');
        }
    }

    $appointments = Appointment::where('date', $date)
                               ->where('doctor_id', $doctor_id)
                               ->pluck('time')
                               ->toArray();
// dd($appointments);

    $availableTimes = [];
    $start = Carbon::createFromTime(9, 0); 
    $end = Carbon::createFromTime(17, 0); 

    while ($start <= $end) {
        $appoint = $start->format('H:i:s');

        if (!in_array($appoint, $appointments)) {
            $availableTimes[] = $appoint;
        }
        $start->addMinutes(30);
    }

    return jsonTrait::jsonResponse(200, 'All available appointment times', $availableTimes);
}


//patient
    public static function bookAppointment(Request $request) {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'description' => 'nullable|string',
        ]);

        // Check if the appointment time is already booked

        $existingAppointment = Appointment::where('date', $request->date)
            ->where('time', $request->time)
            ->where('doctor_id', $request->doctor_id)
            ->first();

        if ($existingAppointment) {
            return jsonTrait::jsonResponse(400,'This time  is already booked ',);
        }

        // Create a new appointment
        $patient_id=auth()->user()->id;
        $appointment = Appointment::create([
            'doctor_id' => $request->doctor_id,
            'patient_id' => $patient_id,
            'date' => $request->date,
            'time' => $request->time,
            'description' => $request->description,
        ]);

        return jsonTrait::jsonResponse(201,'book a appointment ',$appointment);
    }

//doctor
  
public static function getAppointments(Request $request)
{
    $id = auth()->user()->id;
    $search = $request->input('search');

    $query = Appointment::where('doctor_id', $id);
    if ($search) {
        $date = date('Y-m-d', strtotime($search));
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));

        $query->whereMonth('date', $month)->whereYear('date', $year);
    }

    $allAppoint = $query->orderBy('date', 'DESC')->get();

    return jsonTrait::jsonResponse(200, 'All appointments', $allAppoint);
}


//patient
public static function myAppointments(){
    $id=auth()->user()->id;
    $allAppoint=Appointment::where('patient_id',$id)->orderBy('date','DESC')->get();
    return jsonTrait::jsonResponse(200,'All appointment  ',$allAppoint);

}


}
