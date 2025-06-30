<?php

namespace App\Http\Controllers\Admin;

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
        return Inertia::render('Admin/Jobs/Index');
    }

    public function show($id)
    {
        return Inertia::render('Admin/Jobs/Show');
    }

    
    
}
