<?php

namespace App\Http\Controllers\Company;

use App\Events\JobPostDeleted;
use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\Governorate;
use App\Models\JobCategory;
use App\Models\JobPost;
use App\Models\JobType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;


class JobPostController extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::user();
        $jobCategories = JobCategory::all();
        $jobTypes = JobType::all();

            
        $jobs = $user->jobPosts()
        ->where('title', 'like', "{$request->title}%")
        ->filterType($request->job_type)
        ->filterCategory($request->job_category)
        ->with(['user', 'jobCategory', 'jobType', 'governorate'])
        ->withCount('jobApplications')
        ->paginate(1)
        ->withQueryString();


        return Inertia::render('Company/Jobs/Index', 
        [
            'jobs' => $jobs, 
            'jobCategories'=> $jobCategories,
            'jobTypes'=> $jobTypes,
            'jobTypeParam'=> $request->job_type,
            'jobCategoryParam'=> $request->job_category,
            'titleParam'=> $request->title,
        ]
    );
    }

    public function trashed(Request $request)
    {

        $user = Auth::user();
        $jobCategories = JobCategory::all();
        $jobTypes = JobType::all();

            
        $jobs = $user->jobPosts()
        ->onlyTrashed()
        ->where('title', 'like', "{$request->title}%")
        ->filterType($request->job_type)
        ->filterCategory($request->job_category)
        ->with(['user', 'jobCategory', 'jobType', 'governorate'])
        ->withCount('jobApplications')
        ->paginate(1)
        ->withQueryString();



        return Inertia::render('Company/Jobs/Trashed', 
        [
            'jobs' => $jobs, 
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
        
        $jobPost->load('user','jobCategory', 'jobType', 'governorate')->loadCount('jobApplications');
        
        return Inertia::render('Company/Jobs/Show', [
            'jobPost'=> $jobPost,
        ]);
    }

    public function edit(JobPost $jobPost)
    {
        
        $jobCategories = JobCategory::all();
        $jobTypes = JobType::all();
        $governorates = Governorate::all();
        
        $jobPost->load('user','jobCategory', 'jobType', 'governorate');

        return Inertia::render('Company/Jobs/Edit', [
            'job' => $jobPost, 
            'jobCategories'=> $jobCategories,
            'jobTypes'=> $jobTypes,
            'governorates'=> $governorates,

        ]);
    }

    public function create()
    {

        $user = Auth::user();

        $id = $user->companyProfile?->where('user_id', $user->id)->firstOrFail();

        if(!$id){
            return redirect()->route('company.profile.edit', ['user' => $user])->with("error", "you need to complete your profile to create job");
        }
        
        $jobCategories = DB::table('job_categories')->get();
        $jobTypes = DB::table('job_types')->get();
        $governorates = DB::table('governorates')->get();
        return Inertia::render('Company/Jobs/Create', compact('jobCategories', 'jobTypes', 'governorates'));
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $validated = $request->validate( [
            'title' => ['required'],
            'job_category_id' => ['required'],
            'job_type_id' => ['required'],
            'governorate_id' => ['required'],
            'salary' => ['required'],
            'application_deadline' => ['required'],
            'description' => ['required'],
            'requirements' => ['required'],
            'skills' => ['required'],
        ]);

        
        $user = Auth::user();
        $user->jobPosts()->create([
            'title' => $request->title,
            'job_category_id' => $request->job_category_id,
            'job_type_id' => $request->job_type_id,
            'governorate_id' => $request->governorate_id,
            'salary' => $request->salary,
            'application_deadline' => $request->application_deadline,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'skills' => $request->skills,
        ]);

        return redirect()->route('company.jobs.index')->with('success', 'Job Posted');
    }

    public function update(Request $request, JobPost $jobPost)
    {

        $validated = $request->validate( [
            'title' => ['required'],
            'job_category_id' => ['required'],
            'job_type_id' => ['required'],
            'governorate_id' => ['required'],
            'salary' => ['required'],
            'application_deadline' => ['required'],
            'description' => ['required'],
            'requirements' => ['required'],
            'skills' => ['required'],
        ]);

        $jobPost->update([
            'title' => $request->title,
            'job_category_id' => $request->job_category_id,
            'job_type_id' => $request->job_type_id,
            'governorate_id' => $request->governorate_id,
            'salary' => $request->salary,
            'application_deadline' => $request->application_deadline,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'skills' => json_encode($request->skills),
        ]);

        return redirect()->route('company.jobs.index')->with('success', 'Job updated');
    }

    public function softDelete(jobPost $jobPost){
        
        //if you want to delete all applicants files paths for this job
        // $jobPost->load('jobApplications');
        // $filePaths = $jobPost->jobApplications->pluck('resume_path')->all();
        // event(new JobPostDeleted($filePaths));

        $jobPost->update(['status'=>'closed']);
        $jobPost->delete();

        return redirect()->route('company.jobs.index')->with('success', 'Job has Archived successfully');
    }

    public function restore(jobPost $jobPost){
        
    }

    public function forceDelete(jobPost $jobPost){
        

    }
}
