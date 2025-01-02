<?php

namespace App\Services;


use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;

class commentService
{

use jsonTrait;

//doctor && patient
public static function store(Request $request,$post_id)
    {
        $reply=$request->input('replyComment_id');
     $comment=Comment::create([
        'description' =>$request->description,
        'patient_id'  =>auth()->user()->id,
        'post_id'     =>$post_id,
    ]);

    if($reply){
      $comment->replyComment_id=$reply;
      $comment->save();
    }
    return jsonTrait::jsonResponse(200,'add comment',$comment);

    }
    public static function update(Request $request,$comment_id)
    {

        $comment = Comment::findOrFail($comment_id); // Corrected to find the comment by ID
        $post_id=$comment->post_id;
       $comment->update([
        'description' =>$request->description,
        'patient_id' =>auth()->user()->id,
        'post_id' =>$post_id,
    ]);


    return jsonTrait::jsonResponse(200,'update comment',$comment);

    }
    public static function delete($id)
    {
    $comment=Comment::findOrfail($id);
    $comment->delete();
    return jsonTrait::jsonResponse(200,'delete comment',$comment);

    }
    public static function index($post_id)
    {
    $comments=Comment::where('post_id',$post_id)->get();
    return jsonTrait::jsonResponse(200,'disply  comments of this post',$comments);

    }

  
    public static function countPostComments($post_id)
    {
    $comments=Comment::where('post_id',$post_id)->get();
    $count=count($comments);
    return jsonTrait::jsonResponse(200,'count  comments of this post',$count);

    }


}
