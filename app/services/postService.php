<?php
namespace App\Services;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use Illuminate\Support\Facades\Log;

class postService
{

use jsonTrait;
//doctor
public static function allPosts (){
$posts=Post::with(['comments','likes'])->orderBy('created_at', 'DESC')->get();
return jsonTrait::jsonResponse(200, 'All posts with comments  ', $posts);

}
public static function doctorPosts ($doctor_id){
    $posts=Post::with(['comments','likes'])->where( 'doctor_id', $doctor_id)->orderBy('created_at','DESC')->get();
    return jsonTrait::jsonResponse(200, 'All posts of doctor with comments  ', $posts);

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

        public static function storePost(Request $request){
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


        public static function update(Request $request, $id){
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
    public static function softDelete( $id){
       $post= Post::findOrfail($id);

       $post->delete();
    return jsonTrait::jsonResponse(200, 'delete post successfully  ', $post);

    }

    public static function restore($id){
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return jsonTrait::jsonResponse(200, 'Restored post successfully', $post);
    }



}
