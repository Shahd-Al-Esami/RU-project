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
    public  function addPost()
    {

return view('doctor.addPost');
    }

    public  function editPost($id)
    {
           $post=Post::findOrFail($id);
     return view('doctor.addPost',['post'=>$post]);
    }

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
        $posts = PostService::myPosts();

return view('doctor.myPosts',['posts'=>$posts]);    }
    public  function countMyPosts()
    {
        $result = PostService::countMyPosts();

        return response()->json(['message' => $result]);
    }
    public  function storePost(PostRequest $request)
    {
        $result = PostService::storePost($request);

        return redirect()->route('myPosts');
    }
    public  function update($id,PostRequest $request)
    {
        $result = PostService::update($id,$request);
        // dd(request()->all());

        return redirect()->route('myPosts');

    }
    public  function softDelete($id)
    {
         PostService::softDelete($id);
         return redirect()->back();


    }
    public  function restore($id)
    {
        $post = PostService::restore($id);

        return redirect()->back();
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
        $posts = PostService::myDeletedPosts();

return view('doctor.deletedPosts',['posts'=>$posts]);
    }

    //patient


    public  function homePosts()
    {
        $posts = PostService::homePosts();

        return view('patient.posts',['posts'=>$posts]);
    }
}
