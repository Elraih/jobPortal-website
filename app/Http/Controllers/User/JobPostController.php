<?php

namespace App\Http\Controllers\User;

use App\Helpers\CopyFilesHelper;
use App\Helpers\uploadedFilesHelper;
use App\Http\Controllers\Controller;
use App\Models\Governorate;
use App\Models\JobApplication;
use App\Models\JobCategory;
use App\Models\JobPost;
use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Throwable;

class JobPostController extends Controller
{

    // show all job posts page and get filter inputs from request then render
    public function index(Request $request)
    {

        $jobs = JobPost::filterKeyword($request->keyword)
            ->filterType($request->jobTypes)
            ->filterCategory($request->jobCategories)
            ->filterLocation($request->governorates)
            ->where('status', 'open')
            ->orderBy('created_at', 'desc')
            ->with(['jobCategory', 'jobType', 'governorate', 'user.companyProfile'])->paginate()
            ->withQueryString();


        $jobTypes = JobType::all();
        $jobCategories = JobCategory::get();
        $governorates = Governorate::get();


        return Inertia::render(
            'User/Jobs/Index',
            [
                'jobTypes' => $jobTypes,
                'jobs' => $jobs,
                'jobCategories' => $jobCategories,
                'governorates' => $governorates,
                'titleParam' => $request->keyword,
                'jobTypesParam' => $request->jobTypes,
                'jobCategoriesParam' => $request->jobCategories,
                'governoratesParam' => $request->governorates,

            ]
        );
    }


    // show selected jobpost based on slug and show similar jobposts 
    public function show($slug)
    {

        $user = Auth::user();

        $jobPost = JobPost::where('slug', $slug)->firstOrFail();

        $hasApplied = false;
        $status = null;

        if ($user) {
            $hasApplied = $jobPost->jobApplications()
                ->where('user_id', $user->id)
                ->exists();

            $status = $jobPost->jobApplications()
                ->where('user_id', $user->id)
                ->value('status');
        }

        $jobPost->load(['jobCategory', 'jobType', 'governorate', 'user.companyProfile'])->loadCount('jobApplications');

        //get similar jobs and skip the currunt jobPost
        $similarJobs = $jobPost->where('job_category_id', $jobPost->job_category_id)
            ->whereNot('id', $jobPost->id)
            ->with('user.companyProfile')
            ->get();



        $pendingCount = $jobPost->jobApplications()->having('status', 'pending')->count();
        $reviewedCount = $jobPost->jobApplications()->having('status', 'reviewed')->count();
        $inConsiderationCount = $jobPost->jobApplications()->having('status', 'in consideration')->count();
        $rejectedCount = $jobPost->jobApplications()->having('status', 'rejected')->count();


        return Inertia::render('User/Jobs/Show', [
            'jobPost' => $jobPost,
            'similarJobs' => $similarJobs,
            'pendingCount' => $pendingCount,
            'reviewedCount' => $reviewedCount,
            'inConsiderationCount' => $inConsiderationCount,
            'rejectedCount' => $rejectedCount,
            'hasApplied' => $hasApplied,
            'status' => $status
        ]);
    }


    // apply for spisfic jobpost 
    public function apply(JobPost $jobPost)
    {

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $resume_path = $user->resume?->resume;

        // redirect if user dont have resume 
        if (!$resume_path) {
            return redirect()->route('user.profile.show', $user)->with('error', 'complete your profile info');
        }

        // copy the user resume file path and rename it get new path 
        $resume_path = CopyFilesHelper::handleFile($resume_path, $jobPost->slug);


        DB::beginTransaction();
        try {

            JobApplication::create([
                'user_id' => $user->id,
                'job_post_id' => $jobPost->id,
                'resume_path' => $resume_path,
            ]);

            DB::commit();
        } catch (Throwable $e) {
            dd($e);

            DB::rollBack();
        }


        return redirect()->back()->with('success', 'applied to this job');
    }
}
