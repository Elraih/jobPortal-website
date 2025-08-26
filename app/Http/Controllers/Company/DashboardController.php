<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;

use App\Models\JobPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(){

        $user = Auth::user();
        // $count = $user->loadCount(['jobPosts', 'jobPosts.jobApplications']);
        // $count = $user->loadCount('jobPosts');
        $jobPostCount = JobPost::count();
        $companyCount = User::having('role', 'company')->count();
        $userCount = User::having('role', 'job_seeker')->count();
        
        // dd($count);
        return Inertia::render("Company/Dashboard", [
            "$jobPostCount" => $jobPostCount,
            "$companyCount" => $companyCount,
            "$userCount" => $userCount,
        ]
        );
    }
}
