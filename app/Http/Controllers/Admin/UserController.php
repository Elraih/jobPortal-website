<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
       $jobSeekers = User::where('role', 'job_seeker')
       ->with('userProfile', 'contactInfo')
       ->withCount('jobApplications')
       ->paginate();

    //    dd($jobSeekers);
        return Inertia::render('Admin/Users/Index', 
    [
        'jobSeekers' => $jobSeekers
    ]);
    }

    public function trashed()
    {
       $jobSeekers = User::
       onlyTrashed()
       ->where('role', 'job_seeker')
       ->with('userProfile', 'contactInfo')
       ->withCount('jobApplications')
       ->paginate();

    //    dd($jobSeekers);
        return Inertia::render('Admin/Users/Trashed', 
    [
        'jobSeekers' => $jobSeekers
    ]);
    }

    public function show(User $user)
    {
       $user->load('userProfile', 'jobApplications', 'contactInfo', 'skill')->loadCount('jobApplications');
       
       $jobApplications = $user->jobApplications()->with(['jobPost.user.companyProfile', 'jobPost'])->paginate();
       
       return Inertia::render('Admin/Users/Show', [
            'user'=> $user,
            'jobApplications'=> $jobApplications,
        ]);
    }


    public function softDelete(User $user){

        $user->delete();

        return back()->with('success', 'User Has Been Deleted successfully');
    }
}
