<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\CommentService;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public  function store(Request $request,$post_id)
    {
        $result = CommentService::store($request,$post_id);

        return response()->json(['message' => $result]);
    }

    public  function update(Request $request,$comment_id)
    {
        $result = CommentService::update($request,$comment_id);

        return response()->json(['message' => $result]);
    }
    public  function delete($id)
    {
        $result = CommentService::delete($id);

        return response()->json(['message' => $result]);
    }
    public  function index($post_id)
    {
        $result = CommentService::index($post_id);

        return response()->json(['message' => $result]);
    }
    // public  function indexOnlyComments($post_id)
    // {
    //     $result = CommentService::indexOnlyComments($post_id);

    //     return response()->json(['message' => $result]);
    // }
    public  function countPostComments($post_id)
    {
        $result = CommentService::countPostComments($post_id);

        return response()->json(['message' => $result]);
    }
}
