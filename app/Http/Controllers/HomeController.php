<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use App\Models\JobPost;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(Request $request)
    {


        $todayJobs = JobPost::whereDate("created_at","=", Carbon::today()->toDateString())
        ->with(['jobCategory', 'jobType', 'governorate', 'user.companyProfile:user_id,name'])
        ->orderBy('created_at', 'desc')
        ->take(15)
        ->get();

        // dd($todayJobs);
        $jobByCategories = JobCategory::all();
        // dd($todayJobs);
        return Inertia::render('home',[
            'todayJobs'=> $todayJobs,
            'jobByCategories'=> $jobByCategories
        ] );
    }
}
