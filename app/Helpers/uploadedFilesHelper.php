<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;

class uploadedFilesHelper
{
    /**
     * Create a new class instance.
     */
    public static function handleFile(UploadedFile $file, string $directory = 'uploads', string $disk = 'public')
    {
        $extenstion = $file->getClientOriginalExtension();

        $fileName =  uniqid() . time() . ".{$extenstion}";

        $path = $file->storeAs($directory, $fileName, $disk);

        return $path;

    }
}
