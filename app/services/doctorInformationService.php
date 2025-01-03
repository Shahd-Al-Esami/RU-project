<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Models\DoctorInformation;
use Illuminate\Support\Facades\Hash;

class doctorInformationService
{

use jsonTrait;
//doctor

public static function store(Request $request){
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
    return jsonTrait::jsonResponse(200,'my profile',$myProfile);

}
public static function updateProfile(Request $request){
    $id=auth()->user()->id;
    $user=User::findOrFail($id);
    $image=null;
    if(request()->hasFile('image'))
    {
        $file=request()->file('image');
        $image=uploadImage($file,'posts');
    }
    $user1=$user->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'country' => $request->country,
        'age' => $request->age,
        'gender' => $request->gender,
        'phone_number' => $request->phone_number,
        'image' =>$image,
    ]);
   $info= $user->doctorInformation;
    $info1=$info->update([
        'bio' => $request->bio,
        'doctor_id' => $id,

    ]);
    return jsonTrait::jsonResponse(200,'edit profile',[$user1,$info1]);


}

//patient
public static function doctorProfile($id){
    $doctorProfile=User::where('id',$id)->with('doctorInformation')->first();
    return jsonTrait::jsonResponse(200,'doctor profile',$doctorProfile);

}


}
