<?php

namespace App\Services;



use App\Models\Follow;
use App\Http\Traits\jsonTrait;

class followService
{

use jsonTrait;
//doctor
public static function getfollows(){
    $id=auth()->user()->id;
  $follows=Follow::where('doctor_id',$id)->get();
  return jsonTrait::jsonResponse(200,'all follows ',$follows);

}

//patient
public static function followDoctor($doctor_id)
{
    $patient_id = auth()->user()->id;

    $Follow = Follow::where('patient_id', $patient_id)
        ->where('doctor_id', $doctor_id)
        ->first();

    if ($Follow) {
        return jsonTrait::jsonResponse(400, 'Already following this doctor');
    }

    $follow = Follow::create([
        'patient_id' => $patient_id,
        'doctor_id' => $doctor_id,
    ]);

    return jsonTrait::jsonResponse(200, 'Successfully followed the doctor', $follow);
}

}
