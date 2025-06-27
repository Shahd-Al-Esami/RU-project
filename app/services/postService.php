<?php
namespace App\Services;

use App\Models\Post;
use App\Models\Follow;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Log;

class PostService
{

use jsonTrait;
//doctor
public static function allPosts (){
$posts=Post::with(['comments','likes'])->orderBy('created_at', 'DESC')->get();
return $posts;
}


    public static function myPosts (){
        $id=auth()->user()->id;
        $posts=Post::with(['comments','likes'])->where( 'doctor_id', $id)->orderBy('created_at','DESC')->get();
return $posts;
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
                $image = uploadImage('image', 'posts', 'public'); // Correctly passing the file
            }

            $post = Post::create([
                'title'       => $request->title,
                'description' => $request->description,
                'doctor_id'   => auth()->user()->id,
                'image'       => $image,
                'link_source' => $request->link_source,
            ]);
           return $post;
    }


        public static function update($id,PostRequest $request){
            $post = Post::findOrFail($id);
            $image = null;
            if ($request->hasFile('image')) {
                // $file = $request->file('image');
                $image = uploadImage('image', 'posts', 'public'); // Correctly passing the file
            }
            $post=$post->update([
                'title'       => $request->title,
                'description' => $request->description,
                'doctor_id'   => auth()->user()->id,
                'image'       => $image,
                'link_source' => $request->link_source,
            ]);
           return $post;
        }
    public static function softDelete($id){
       $post= Post::findOrfail($id);

       $post->delete();
        return session()->flash('success', 'post has deleted Successfully');
    }

    public static function restore($id){
        $postdeleted = Post::withTrashed()->findOrFail($id);
        $post=$postdeleted->restore();

return $post;
    }
//admin
    public static function getDeletedPosts(){
        $posts = Post::onlyTrashed()->get();

return $posts;    }
//doctor
    public static function myDeletedPosts(){
        $id=auth()->user()->id;
        $posts = Post::onlyTrashed()->where('doctor_id',$id)->get();

return $posts;    }
    //patient
    public static function doctorPosts ($doctor_id){
        $posts=Post::with(['comments','likes'])->where( 'doctor_id', $doctor_id)->orderBy('created_at','DESC')->get();
        return jsonTrait::jsonResponse(200, 'All posts of doctor with comments  ', $posts);

        }


    public static function homePosts (){
        $id=auth()->user()->id;

        $doctor_ids= Follow::where('patient_id',$id)->pluck('doctor_id')->all();

        $posts=Post::whereIn('doctor_id',$doctor_ids)->latest()->take(10)->get();

         return $posts;
        }

}
