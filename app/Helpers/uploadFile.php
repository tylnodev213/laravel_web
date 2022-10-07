<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

function store(Request $request)
{
    $path = Storage::putFile(
        'avatars', $request->file('avatar')
    );

    return $path;
}

function remove($file_name)
{
    if(file_exists(url('storage')."/app/".$file_name)) {
        Storage::delete($file_name);
    }

}
