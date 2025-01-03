<?php
namespace App\Services;

use App\Models\Post;
use App\Models\Follow;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Log;

class postService
{

use jsonTrait;
//doctor
public static function allPosts (){
$posts=Post::with(['comments','likes'])->orderBy('created_at', 'DESC')->get();
return jsonTrait::jsonResponse(200, 'All posts with comments  ', $posts);

}


    public static function myPosts (){
        $id=auth()->user()->id;
        $posts=Post::with(['comments','likes'])->where( 'doctor_id', $id)->orderBy('created_at','DESC')->get();
        return jsonTrait::jsonResponse(200, 'All posts of doctor with comments  ', $posts);

        }

        public static function countMyPosts (){
            $id=auth()->user()->id;
            $posts=Post::where( 'doctor_id', $id)->get();
            $count=count($posts);
            return jsonTrait::jsonResponse(200, 'count of my posts   ', $count);

            }

        public static function storePost(PostRequest $request){
            $image = null;
            if ($request->hasFile('image')) {
                $image = uploadImage($request->file('image'), 'posts', 'public'); // Correctly passing the file
            }

            $post = Post::create([
                'title'       => $request->title,
                'description' => $request->description,
                'doctor_id'   => auth()->user()->id,
                'image'       => $image,
                'link_source' => $request->link_source,
            ]);
            return jsonTrait::jsonResponse(201, 'Stored posts successfully', $post);
        }


        public static function update(PostRequest $request,$id){
            $post = Post::findOrFail($id);
            $image = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $image = uploadImage($file, 'posts', 'public'); // Correctly passing the file
            }
            $post->update([
                'title'       => $request->title,
                'description' => $request->description,
                'doctor_id'   => auth()->user()->id,
                'image'       => $image,
                'link_source' => $request->link_source,
            ]);
            return jsonTrait::jsonResponse(200, 'Updated post successfully', $post);
        }
    public static function softDelete($id){
       $post= Post::findOrfail($id);

       $post->delete();
    return jsonTrait::jsonResponse(200, 'delete post successfully  ', $post);

    }

    public static function restore($id){
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return jsonTrait::jsonResponse(200, 'Restored post successfully', $post);
    }
//admin
    public static function getDeletedPosts(){
        $posts = Post::onlyTrashed()->get();

        return jsonTrait::jsonResponse(200, 'Retrieved deleted posts successfully', $posts);
    }
//doctor
    public static function myDeletedPosts(){
        $id=auth()->user()->id;
        $posts = Post::onlyTrashed()->where('doctor_id',$id)->get();

        return jsonTrait::jsonResponse(200,  '  Retrieved my deleted posts successfully', $posts);
    }
    //patient
    public static function doctorPosts ($doctor_id){
        $posts=Post::with(['comments','likes'])->where( 'doctor_id', $doctor_id)->orderBy('created_at','DESC')->get();
        return jsonTrait::jsonResponse(200, 'All posts of doctor with comments  ', $posts);

        }


    public static function homePosts (){
        $id=auth()->user()->id;

        $doctor_ids= Follow::where('patient_id',$id)->pluck('doctor_id')->all();

        $posts=Post::whereIn('doctor_id',$doctor_ids)->latest()->take(10)->get();

        return jsonTrait::jsonResponse(200, 'Latest 10 posts from followed doctors ', $posts);

        }

}
