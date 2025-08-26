<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CompanyController extends Controller
{
    // show all companies listed 
    public function index(Request $request)
    {

        $companies = User::where('role', 'company')
            ->filterCompanyName($request->companyName)
            ->with('companyProfile', 'contactInfo')
            ->withCount('jobPosts')
            ->paginate();

        return Inertia::render('Admin/Company/Index', [
            'companies' => $companies,
            'companyNameParam' => $request->companyName,
        ]);
    }

    // show all softdeleted companies listed 
    public function trashed(Request $request)
    {


        $companies = User::onlyTrashed()
            ->where('role', 'company')
            // ->filterCompanyName($request->companyName)
            ->filterCompanyName($request->companyName)
            ->with('companyProfile', 'contactInfo')
            ->withCount('jobPosts')
            ->paginate();

        return Inertia::render('Admin/Company/Trashed', ['companies' => $companies]);
    }

    // show spisific company  
    public function show(User $user)
    {

        $user->load('companyProfile', 'jobPosts', 'contactInfo', 'location.governorate')
            ->loadCount('jobPosts', 'jobApplications');

        $jobPosts = $user->jobPosts()->with(['jobType', 'governorate'])->withCount('jobApplications')->paginate();
        return Inertia::render(
            'Admin/Company/Show',
            [
                'company' => $user,
                'jobPosts' => $jobPosts,
            ]
        );
    }

    // softdelete company  and update the jobposts after deleted
    public function softDelete(User $user)
    {


        $user->jobPosts()->update([
            'application_deadline' => Date::now(),
            'status' => 'closed'
        ]);

        $user->delete();

        return redirect()->back()->with('success', 'Company has Archived successfully');
    }
}
