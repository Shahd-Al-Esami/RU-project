<?php

if(!function_exists('uploadImage')){
function uploadImage($file,$folder,$disk="public"){
    if(request()->hasFile($file)){
        try {
            $file=request()->file($file);
            $image=time().$file->getClientOriginalName();
            $path=$file->storeAs($folder,$image,$disk);
            return $path;
        } catch (Exception $e) {
            // Handle any exceptions that occur during the upload process
            return response()->json(['message' => 'File upload failed: ' . $e->getMessage()], 500);
        }
    }
    // else{
    //     return response()->json(['message' => 'No file uploaded'], 400);

    // }

 }
}
