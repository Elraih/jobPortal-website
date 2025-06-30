<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class JobApplicationController extends Controller
{
    public function index()
    {
        $applications = DB::table('job_applications')->get();
        return Inertia::render('Company/JobApplications/Index', 
        ['applications' => $applications]
    );
    }

    public function show(){
        $application = DB::table('job_applications')->get();

        return Inertia::render('Company/JobApplications/Show', [
            'application' => $application,
        ]);
    }
}
