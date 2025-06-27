<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class JobPostController extends Controller
{
    public function index()
    {
        return Inertia::render('Company/Jobs/Index');
    }

    public function show($id)
    {
        return Inertia::render('Company/Jobs/Show');
    }

    public function create()
    {
        
        $jobCategories = DB::table('job_categories')->get();
        $jobTypes = DB::table('job_types')->get();
        $governorates = DB::table('governorates')->get();
        return Inertia::render('Company/Jobs/Create', compact('jobCategories', 'jobTypes', 'governorates'));
    }
    public function store(Request $request)
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

        JobPost::created($request->all());

        return redirect()->route('jobs.index')->with('success', 'Job Posted');
    }
}
