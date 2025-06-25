<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function registerAsCompany(){
        return Inertia::render('Auth/RegisterCompany');

    }
    public function registerAsJobSeeker(){
        return Inertia::render('Auth/RegisterJobSeeker');

    }

    public function store(){
        
    }
}
