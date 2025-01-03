<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //doctor
    public  function allPosts()
    {
        $result = PostService::allPosts();

        return response()->json(['message' => $result]);
    }
    public  function doctorPosts($doctor_id)
    {
        $result = PostService::doctorPosts($doctor_id);

        return response()->json(['message' => $result]);
    }

    public  function myPosts()
    {
        $result = PostService::myPosts();

        return response()->json(['message' => $result]);
    }
    public  function countMyPosts()
    {
        $result = PostService::countMyPosts();

        return response()->json(['message' => $result]);
    }
    public  function storePost(PostRequest $request)
    {
        $result = PostService::storePost($request);

        return response()->json(['message' => $result]);
    }
    public  function update($id,PostRequest $request)
    {

        $result = PostService::update($request,$id);

        return response()->json(['message' => $result]);
    }
    public  function softDelete($id)
    {
        $result = PostService::softDelete($id);

        return response()->json(['message' => $result]);
    }
    public  function restore($id)
    {
        $result = PostService::restore($id);

        return response()->json(['message' => $result]);
    }
    //admin
    public  function getDeletedPosts()
    {
        $result = PostService::getDeletedPosts();

        return response()->json(['message' => $result]);
    }
    //doctor
    public  function myDeletedPosts()
    {
        $result = PostService::myDeletedPosts();

        return response()->json(['message' => $result]);
    }

    //patient


    public  function homePosts()
    {
        $result = PostService::homePosts();

        return response()->json(['message' => $result]);
    }
}
