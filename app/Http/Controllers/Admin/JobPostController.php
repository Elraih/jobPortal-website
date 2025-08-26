<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobCategory;
use App\Models\JobPost;
use App\Models\JobType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class JobPostController extends Controller
{
    public function index(Request $request)
    {

        $jobCategories = JobCategory::all();
        $jobTypes = JobType::all();

        $jobs = JobPost::where('title', 'like', "{$request->title}%")
        ->filterType($request->job_type)
        ->filterCategory($request->job_category)
        ->with("jobType", "jobCategory","governorate","user.companyProfile")
        ->withCount('jobApplications')
        ->paginate()
        ->withQueryString();

        return Inertia::render('Admin/Jobs/Index', [
            'jobPosts' => $jobs, 
            'jobCategories'=> $jobCategories,
            'jobTypes'=> $jobTypes,
            'jobTypeParam'=> $request->job_type,
            'jobCategoryParam'=> $request->job_category,
            'titleParam'=> $request->title,
        ]);
    }

    public function trashed(Request $request)
    {

        $jobCategories = JobCategory::all();
        $jobTypes = JobType::all();

            
        $jobs = JobPost::
         onlyTrashed()
        ->where('title', 'like', "{$request->title}%")
        ->filterType($request->job_type)
        ->filterCategory($request->job_category)
        ->with(['user.companyProfile', 'jobCategory', 'jobType', 'governorate'])
        ->withCount('jobApplications')
        ->paginate()
        ->withQueryString();



        return Inertia::render('Admin/Jobs/Trashed', 
        [
            'jobPosts' => $jobs, 
            'jobCategories'=> $jobCategories,
            'jobTypes'=> $jobTypes,
            'jobTypeParam'=> $request->job_type,
            'jobCategoryParam'=> $request->job_category,
            'titleParam'=> $request->title,
        ]
    );
    }

    public function show($slug)
    {

        $jobPost = JobPost::withTrashed()->where('slug', $slug)->firstOrFail();

        $jobPost->load("jobType","jobCategory","governorate","user.companyProfile",'user')
        ->loadCount('jobApplications')
        ->get();

        $jobSeekres = $jobPost->jobApplications()->with(['user.location', 'user.userProfile','user.contactInfo'])->paginate();

        // dd($jobSeekres);
        return Inertia::render('Admin/Jobs/Show', [
            'jobPost'=> $jobPost,
            'jobSeekres'=> $jobSeekres
        ]);
    }


    public function softDelete(JobPost $jobPost){

        $jobPost->update(['status'=>'closed']);
        $jobPost->delete();

        return redirect()->route('admin.jobs.index')->with('success', 'Job has Archived successfully');
    }
    
    
}
