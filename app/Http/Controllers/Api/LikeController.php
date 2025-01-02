<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\likeService;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    public  function getlikes($post_id)
    {
        $result = likeService::getlikes( $post_id);

        return response()->json(['message' => $result]);
    }

    public  function countlikes($post_id)
    {
        $result = likeService::countlikes( $post_id);

        return response()->json(['message' => $result]);
    }
//patient
      public  function createLike($post_id)
    {
        $result = likeService::createLike( $post_id);

        return response()->json(['message' => $result]);
    }
    public  function disLike($post_id)
    {
        $result = likeService::disLike($post_id);

        return response()->json(['message' => $result]);
    }
}
