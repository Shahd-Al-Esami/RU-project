<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\postService;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //doctor
    public  function allPosts()
    {
        $result = postService::allPosts();

        return response()->json(['message' => $result]);
    }
    public  function doctorPosts($doctor_id)
    {
        $result = postService::doctorPosts($doctor_id);

        return response()->json(['message' => $result]);
    }

    public  function myPosts()
    {
        $result = postService::myPosts();

        return response()->json(['message' => $result]);
    }
    public  function countMyPosts()
    {
        $result = postService::countMyPosts();

        return response()->json(['message' => $result]);
    }
    public  function storePost(Request $request)
    {
        $result = postService::storePost($request);

        return response()->json(['message' => $result]);
    }
    public  function update($id,Request $request)
    {

        $result = postService::update($request,$id);

        return response()->json(['message' => $result]);
    }
    public  function softDelete($id)
    {
        $result = postService::softDelete($id);

        return response()->json(['message' => $result]);
    }
    public  function restore($id)
    {
        $result = postService::restore($id);

        return response()->json(['message' => $result]);
    }
}
