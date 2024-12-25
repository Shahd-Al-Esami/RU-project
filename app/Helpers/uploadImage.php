<?php

if(!function_exists('uploadImage')){
function uploadImage($file,$folder,$disk="public"){
    if(request()->hasFile($file)){
        $file=request()->file($file);
        $image=time().$file->getClientOriginalName();
        $path=$file->storeAs($folder,$image,$disk);
      return $path;
}
    else{
        return response()->json(['message' => 'No file uploaded'], 400);

    }

 }
}
