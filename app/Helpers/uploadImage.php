<?php


if(!function_exists('uploadImage')){
function uploadImage($file,$folder,$disk="public"){
    if(request()->hasFile($file)){
        $file=request()->file($file);
       $imageName= time() . '_' . $file->getClientOriginalName();
        $path=$file->storeAs($folder,$imageName,$disk);
        return $path;

    }


 }
}
