<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Models\DoctorInformation;
use Illuminate\Support\Facades\Hash;

class DoctorInformationService
{

use jsonTrait;
//doctor

public static function storeProfile(Request $request){
    $request->validate([
        'bio' =>  'required', 'string', 'max:255',

    ]);
    $id=auth()->user()->id;
$info=DoctorInformation::create([
    'bio' => $request->bio,
    'doctor_id' => $id,
]);
    return jsonTrait::jsonResponse(200,'information of doctor',$info);

}
public static function myProfile(){
    $id=auth()->user()->id;
    $myProfile=User::where('id',$id)->with('doctorInformation')->first();
return $myProfile;
}

public static function adminProfile(){
    $id=auth()->user()->id;
    $myProfile=User::where('id',$id)->first();
return $myProfile;
}
public static function updateProfile(Request $request){
    $id=auth()->user()->id;
    $user=User::findOrFail($id);
    $path=null;
    if(request()->hasFile('image'))
    {
        $path = uploadImage('image', $user->role == 'doctor' ? 'doctors' : ($user->role == 'patient' ? 'patients' : 'admins'), 'public');
    }
    $user1=$user->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'country' => $request->country,
        'age' => $request->age,
        'gender' => $request->gender,
        'phone_number' => $request->phone_number,
        'image' =>$path,
    ]);
    if(!auth()->user()->role==='admin'){
   $info= $user->doctorInformation;
    $info1=$info->update([
        'bio' => $request->bio,
        'doctor_id' => $id,


    ]);
    $user->doctorHoliday()->delete();

    foreach ($request->day as $day) {
        $user->doctorHoliday()->create([
            'day' => $day,
            'doctor_id' => $user->id,
        ]);
    }
return [$user1,$info1];


}
return [$user1];

}


public static function editProfile($id){
    $doctorProfile=User::where('id',$id)->with(['doctorInformation','doctorHoliday'])->firstOrFail();

return $doctorProfile;
}
//patient
public static function doctorProfile($id){
    $doctorProfile=User::where('id',$id)->firstOrFail();

return $doctorProfile;
}


}
