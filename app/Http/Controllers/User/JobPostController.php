<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class JobPostController extends Controller
{
    public function index(Request $request)
    {
        
        $jobTypes = DB::table('job_types')->get();
        

        $filters =$request->only(['keyword']);
        
        $jobs = JobPost::filter($filters)->get();
        
        return Inertia::render('User/Jobs/Index', 
        [
            'jobtypes' => $jobTypes,
            'jobs' => $jobs,
        ]
    );
    }

    public function show($id)
    {
        return Inertia::render('User/Jobs/Show');
    }

    
}
