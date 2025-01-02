<?php

namespace App\Services;



use App\Models\Like;
use App\Models\User;
use App\Http\Traits\jsonTrait;

class likeService
{

use jsonTrait;
//doctor
public static function getlikes($post_id){
  $likes=Like::where('post_id',$post_id)->pluck('patient_id')->all();
  $users=User::whereIn('id',$likes)->get();
  return jsonTrait::jsonResponse(200,'all users who like of this post',$users);

}
public static function countlikes($post_id){
    $counts=Like::where('post_id',$post_id)->count();
    return jsonTrait::jsonResponse(200,'count likes of this post',$counts);

  }
  //patient

public static function createLike($post_id){
    $id=auth()->user()->id;

    $Like = Like::where('patient_id', $id)
    ->where('post_id', $post_id)
    ->first();

if ($Like) {
    return jsonTrait::jsonResponse(400, 'Already like this post');
}
    $like=Like::create([
        'patient_id' => $id,
        'post_id' => $post_id,
]);
    return jsonTrait::jsonResponse(200,'you like this post',$like);

  }

  public static function disLike($post_id){
    $id=auth()->user()->id;
    $Like = Like::where('patient_id', $id)
    ->where('post_id', $post_id)
    ->first();
    if ($Like){

     $Like->delete();
    }else{
     return jsonTrait::jsonResponse(200,'you already dislike this post',);
    }



    return jsonTrait::jsonResponse(200,'dis like this post',);

  }

}
