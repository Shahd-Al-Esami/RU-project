<?php

namespace App\Services;



use App\Models\Post;
use App\Models\User;
use App\Models\Follow;
use App\Http\Traits\jsonTrait;

class followService
{

use jsonTrait;
//doctor
public static function getfollows(){
    $id=auth()->user()->id;
  $follows=Follow::where('doctor_id',$id)->pluck('patient_id')->all();
  $users=User::whereIn('id',$follows)->get();
  return jsonTrait::jsonResponse(200,'all users who follow for me ',$users);

}

public static function countfollows(){
    $id = auth()->user()->id;
    $count = Follow::where('doctor_id', $id)->count();
    return jsonTrait::jsonResponse(200, 'count follows for me', $count);
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
       // Fetch the last 10 posts from the followed doctor
       $posts = Post::where('doctor_id', $doctor_id)
       ->orderBy('created_at', 'desc')
       ->take(10)
       ->get();

    return jsonTrait::jsonResponse(200, 'Successfully followed the doctor',
    ['follow'=>$follow,'posts'=>$posts]);
}


public static function disfollowDoctor($doctor_id)
{
    $patient_id = auth()->user()->id;

    $Follow = Follow::where('patient_id', $patient_id)
        ->where('doctor_id', $doctor_id)
        ->first();

    if ($Follow) {
        $Follow->delete();
        return jsonTrait::jsonResponse(400, ' unfollowing this doctor successfully');
    }

    return jsonTrait::jsonResponse(200, 'already unfollowed the doctor',
    );
}


public static function myFollowers(){
    $id=auth()->user()->id;
    $doctorIds=Follow::where('patient_id',$id)->pluck( 'doctor_id')->all();
     $doctors=User::whereIn('id',$doctorIds)->pluck('name')->all();

    return jsonTrait::jsonResponse(200,'all doctors following ',$doctors);

}
}
