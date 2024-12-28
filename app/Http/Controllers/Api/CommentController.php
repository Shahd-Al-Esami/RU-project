<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\commentService;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public  function store(Request $request,$post_id)
    {
        $result = commentService::store($request,$post_id);

        return response()->json(['message' => $result]);
    }

    public  function update(Request $request,$comment_id)
    {
        $result = commentService::update($request,$comment_id);

        return response()->json(['message' => $result]);
    }
    public  function delete($id)
    {
        $result = commentService::delete($id);

        return response()->json(['message' => $result]);
    }
    public  function index($post_id)
    {
        $result = commentService::index($post_id);

        return response()->json(['message' => $result]);
    }
    // public  function indexOnlyComments($post_id)
    // {
    //     $result = commentService::indexOnlyComments($post_id);

    //     return response()->json(['message' => $result]);
    // }
    public  function countPostComments($post_id)
    {
        $result = commentService::countPostComments($post_id);

        return response()->json(['message' => $result]);
    }
}
