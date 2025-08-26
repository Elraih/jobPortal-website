<?php

namespace App\Http\Controllers\Company;

use App\Enums\JobApplicationStatus;
use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class JobApplicationController extends Controller
{
    public function index(Request $request, JobPost $jobPost)
    {

        $applications = $jobPost->jobApplications()
        ->with('user.contactInfo', 'user.userProfile')
        ->filterName($request->name)
        ->filterStatus($request->status)
        ->paginate()
        ->withQueryString();

        $jobPost->load('governorate', 'jobType', 'jobCategory');

        $jobApplicationStatus = JobApplicationStatus::keyValue();
       
        return Inertia::render('Company/JobApplications/Index',[
            'applications' => $applications,
            'jobApplicationStatus' => $jobApplicationStatus,
            'jobPost' => $jobPost,
            'nameParam' => $request->name,
            'statusParam' => $request->status,
        ]);

    }

    public function show(JobPost $jobPost){
        // $jobApplication->load('');
        $application = DB::table('job_applications')->get();

        return Inertia::render('Company/JobApplications/Show', [
            'application' => $application,
        ]);
    }

    public function downloadResume(jobApplication $jobApplication){
        dd($jobApplication->resume_path);
        
    }

    public function reviewApplication(jobApplication $jobApplication){
    
        if($jobApplication->status != 'reviewed'){
            
            $jobApplication->update([
                'status' => 'reviewed'
            ]);
        }

        // return redirect()->back()->with('success', 'application reviewed');
    }

    public function inConsiderApplication(jobApplication $jobApplication){


    }

    public function rejectApplication(jobApplication $jobApplication){

    }

   
}
