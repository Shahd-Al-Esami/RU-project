<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\postService;
use App\Http\Requests\PostRequest;
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
    public  function storePost(PostRequest $request)
    {
        $result = postService::storePost($request);

        return response()->json(['message' => $result]);
    }
    public  function update($id,PostRequest $request)
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
    //admin
    public  function getDeletedPosts()
    {
        $result = postService::getDeletedPosts();

        return response()->json(['message' => $result]);
    }
    //doctor
    public  function myDeletedPosts()
    {
        $result = postService::myDeletedPosts();

        return response()->json(['message' => $result]);
    }

    //patient


    public  function homePosts()
    {
        $result = postService::homePosts();

        return response()->json(['message' => $result]);
    }
}
