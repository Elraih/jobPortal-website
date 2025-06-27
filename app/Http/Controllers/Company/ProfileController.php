<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function show(){
        return Inertia::render('Company/Profile/Show');
    }

    public function edit(){
        return Inertia::render('Company/Profile/Edit');
    }


}
