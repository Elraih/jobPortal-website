<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(){

        $jobPostCount = JobPost::count();
        $companyCount = User::having('role', 'company')->count();
        $userCount = User::having('role', 'job_seeker')->count();
        
        return Inertia::render("Admin/Dashboard", [
            "jobPostCount" => $jobPostCount,
            "companyCount" => $companyCount,
            "userCount" => $userCount,
        ]
        );
        
    }
}

