<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class EducationController extends Controller
{

    // show edit user education page 
    public function editEducation(User $user)
    {

        Gate::authorize('update', $user);

        $educations = $user->educations()->get();

        // $degree = Education::pluck('degree')->all();

        return Inertia::render("User/Profile/EditEducation", [
            "user" => $user,
            'educations' => $educations
        ]);
    }

    // show edit user education page 
    public function deleteEducation(Request $request, Education $education)
    {

        $education->delete();

        return back()->with('success', 'Education removed Successfully');
    }


    // update user education  
    public function updateEducation(Request $request, User $user)
    {

        $validated = $request->validate([
            'educations' => ['required', 'array'],
            'educations.*.degree' => ['required'],
            'educations.*.major' => ['required'],
            'educations.*.school_name' => ['required'],
            'educations.*.start_date' => ['required'],
            'educations.*.completion_date' => ['required'],
            'educations.*.id' => ['sometimes']
        ]);

        // $user = Auth::user();

        // loop throw the array and update or craete new if not exists 
        foreach ($validated['educations'] as $education) {

            $user->educations()->updateOrCreate(
                ['id' => $education['id']],
                [
                    'degree' => $education['degree'],
                    'major' => $education['major'],
                    'school_name' => $education['school_name'],
                    'start_date' => $education['start_date'],
                    'completion_date' => $education['completion_date'],
                ]
            );
        }

        return redirect()->route('user.profile.show', $user)->with('success', 'education updated successfully');
    }
}
