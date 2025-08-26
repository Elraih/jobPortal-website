<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{

    // download reume if user wanted to see it 
    public function downloadResume(Resume $resume)
    {

        if (Storage::disk('public')->exists($resume->resume)) {
            return response()->download(storage_path('app/public/' . $resume->resume), 'resume.pdf');
        }

        return redirect()->back()->with('error', 'Resume Not Found');
    }
}
