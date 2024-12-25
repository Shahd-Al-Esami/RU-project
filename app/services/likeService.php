<?php

namespace App\Services;



use App\Models\Like;
use App\Http\Traits\jsonTrait;

class likeService
{

use jsonTrait;
//doctor
public static function getlikes($post_id){
  $likes=Like::where('post_id',$post_id)->get();
  return jsonTrait::jsonResponse(200,'all likes of this post',$likes);

}

}
