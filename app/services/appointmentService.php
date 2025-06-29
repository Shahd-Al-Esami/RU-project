<?php

namespace App\Services;


use Carbon\Carbon;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;

class AppointmentService
{

use jsonTrait;

//patient
public static function getAvailable(Request $request) {
    $doctor = User::findOrFail($request->doctor_id);
    $day = Carbon::parse($request->date)->format('l'); // ستظهر اليوم باللغة الانكليزية

    foreach ($doctor->doctorHoliday as $holiday) {
        if (stripos($day, $holiday->day) !== false) {
            // If it's a holiday, flash message and redirect back
           return session()->flash('message', 'This day is a holiday,Please choice another day');
        }
      }

            $appointments = Appointment::where('date', $request->date)
            ->where('doctor_id', $request->doctor_id)
            ->pluck('time')
            ->toArray();

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


            return $availableTimes;
        }






//patient
    public static function bookAppointment(Request $request) {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i:s',
            'description' => 'nullable|string',
        ]);

        // Check if the appointment time is already booked

        $existingAppointment = Appointment::where('date', $request->date)
            ->where('time', $request->time)
            ->where('doctor_id', $request->doctor_id)
            ->first();

        if ($existingAppointment) {
            return ['message'=>'This time  is already booked '];
        }
        // Create a new appointment
        $patient_id=auth()->user()->id;
        $appointment = Appointment::create([
            'doctor_id' => $request->doctor_id,
            'patient_id' => $patient_id,
            'date' => $request->date,
            'time' => $request->time,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return $appointment;
    }

//doctor

public static function getAppointments(Request $request)
{
    $id = auth()->user()->id;
    $search = $request->input('search');

    $query = Appointment::where('doctor_id', $id);
    if ($search) {
        $query->whereDate('date', '=', $search);


     }

    $appointments = $query->orderBy('date', 'DESC')->get();

    return view('doctor.apoointments',['appointments'=>$appointments]);
}

//admin
public static function getAllAppointments(Request $request)
{
    $search = $request->input('search');

    if ($search) {
        // Filter appointments by the search date
        $appointments = Appointment::whereDate('date', '=', $search)
            ->orderBy('date', 'DESC')
            ->get();
    } else {
        // Fetch all appointments ordered by date descending
        $appointments = Appointment::orderBy('date', 'DESC')->get();
    }

    return view('admin.apoointments', ['appointments' => $appointments]);
}

//patient
public static function myAppointments(){
    $id=auth()->user()->id;
    $allAppoint=Appointment::where('patient_id',$id)->orderBy('date','DESC')->get();
      return $allAppoint;
       }

       public static function cancelStatus(Request $request, $id)

       {
        // Validate the incoming status
        $validatedData = $request->validate([
            'status' => 'required|string|in:cancel,done'
        ]);

        // Find the appointment
        $appointment = Appointment::findOrFail($id);

        // Update the status
        $appointment->status = $validatedData['status'];
        $appointment->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Appointment status updated successfully.');
    }

    public static function doneStatus(Request $request, $id)

    {
     // Validate the incoming status
     $validatedData = $request->validate([
         'status' => 'required|string|in:cancel,done'
     ]);

     // Find the appointment
     $appointment = Appointment::findOrFail($id);

     // Update the status
     $appointment->status = $validatedData['status'];
     $appointment->save();

     // Redirect back with a success message
     return redirect()->back()->with('success', 'Appointment status updated successfully.');
 }


}
