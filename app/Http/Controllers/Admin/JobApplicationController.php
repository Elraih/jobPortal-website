<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class JobApplicationController extends Controller
{
    public function index()
    {
        $applications = DB::table('job_applications')->get();
        return Inertia::render('Admin/JobApplications/Index', compact('applications'));
    }
}
