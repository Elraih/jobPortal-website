<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $query = DB::table('job_posts');
        if($request->filled('keyword')){
            $keyword = $request->query('keyword');
            $query = $query->where('title', 'like', "%{$keyword}%")->get();
        }

        $jobs = $query;
        // $jobs = DB::table('job_posts')->get();
        // dd($jobs);
        return Inertia::render('home');
    }
}
