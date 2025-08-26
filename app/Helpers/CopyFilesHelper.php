<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CopyFilesHelper
{
    /**
     * Create a new class instance.
     */
    public static function handleFile($file, $newName)
    {
        $ext = explode('.', $file)[1];
        
        $filename = 'uploads/' . $newName . uniqid() . '.' . $ext;

        if (Storage::disk('public')->copy($file, $filename)) {
            return $filename; // Return the path instead of true
        } else {
            return false;
        }

    }
}
