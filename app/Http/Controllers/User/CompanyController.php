<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function index(){

        return Inertia::render('User/Company/Index');
    }

    public function show(){

        return Inertia::render('User/Company/Show');
    }
}
