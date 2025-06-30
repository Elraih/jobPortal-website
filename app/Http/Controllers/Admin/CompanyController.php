<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = DB::table('companies')->get();
        return Inertia::render('Admin/company/Index', compact('companies'));
    }

    public function show()
    {
        
        return Inertia::render('Admin/company/Show');
    }
    
}
