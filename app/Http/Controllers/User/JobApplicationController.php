<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class JobApplicationController extends Controller
{

    // show user applications for applied jobs 
    public function index()
    {
        $user = Auth::user();


        $totalApplicationsCount = $user->loadCount('jobApplications');

        // get the applied jobs and count of users applied for this job
        $jobApplications  = $user->jobApplications()->with([
            'jobPost' => fn($q) => $q->withCount('jobApplications')
                ->with('user.companyProfile')

        ])->paginate();

        return Inertia::render('User/JobApplications/Index', [
            'jobApplications' => $jobApplications,
            'totalApplicationsCount' => $totalApplicationsCount,
            // 'similarJobs'=> $similarJobs,
        ]);
    }
}
