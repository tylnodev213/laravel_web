<?php


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

function storeFile($request)
{
    $path = Storage::putFile(
        config('constants.folder_avatar'), $request->file('avatar')
    );

    return Str::of($path)->after(config('constants.url_avatar'));
}

function removeFile($file_name)
{
    Storage::delete($file_name);
}
