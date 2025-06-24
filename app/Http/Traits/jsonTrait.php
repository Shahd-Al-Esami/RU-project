<?php
namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

trait jsonTrait{


    // function uploadImage($file,$folder,$disk="public"){
    //     if(request()->hasFile($file)){
    //         $file=request()->file($file);
    //        $imageName= time() . '_' . $file->getClientOriginalName();
    //         // $image=time().$file->getClientOriginalName();
    //         $path=$file->storeAs($folder,$imageName,$disk);
    //         return $path;}}
public static function jsonResponse(int $status=200,$message='success',$data=null): JsonResponse{
    return response()->json([
        'status'=>$status,
        'message'=>$message,
        'data'=>$data,
    ]);
}
}
?>
