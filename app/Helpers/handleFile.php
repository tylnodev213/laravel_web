<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

function storeFile($request)
{
    try {
        $path = Storage::putFile(
            config('constants.folder_avatar'), $request->file('avatar')
        );
    }catch (Throwable  $e){
        return null;
    }

    return Str::after($path,config('constants.folder_avatar').'/');
}

function removeFile($file_name)
{
    try {
        Storage::delete(config('constants.folder_avatar').'/'.$file_name);
    }catch (Throwable  $e){
        return null;
    }

}
