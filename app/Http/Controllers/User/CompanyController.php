<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{

    // show company profile and job posts 
    public function show(User $user)
    {

        $companyProfile = $user->load('companyProfile', 'contactInfo', 'location.governorate');
        $jobPosts = $user->jobPosts()->with(['jobType', 'jobCategory', 'governorate'])->paginate();

        return Inertia::render(
            'User/Company/Show',
            [
                'company' => $companyProfile,
                'jobPosts' => $jobPosts,
            ]
        );
    }
}
