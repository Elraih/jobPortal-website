<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function show(User $user){

         $user->load(['userProfile', 'contactInfo', 'experiences', 'skill', 'educations', 'location.governorate']);
        
        return Inertia::render('Company/Users/Show', [
            'user'=> $user
        ]);
    }
}
