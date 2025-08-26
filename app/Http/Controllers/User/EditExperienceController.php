<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Experience;
use App\Models\User;
use FFI\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class EditExperienceController extends Controller
{

    // show edit user experience page 
    public function editExperience(User $user)
    {

        Gate::authorize('update', $user);

        $user->load('experiences');
        $experiences = $user->experiences;


        return Inertia::render(
            'User/Profile/EditExperience',
            [
                'user' => $user,
                'experiences' => $experiences
            ]
        );
    }

    // delete user experience
    public function deleteExperience(Experience $experience)
    {

        $experience->delete();

        return back()->with('success', 'Experience removed Successfully');
    }

    // update user experience 
    public function updateExperience(Request $request, User $user)
    {

        $validation = $request->validate(
            [
                'experiences' => ['required', 'array'],
                'experiences.*.job_title' => ['required'],
                'experiences.*.id' => ['nullable'],
                'experiences.*.employeer' => ['required'],
                'experiences.*.city' => ['required'],
                'experiences.*.country' => ['required'],
                'experiences.*.start_date' => ['required'],
                'experiences.*.end_date' => ['required'],
                'experiences.*.description' => ['required'],
            ]
        );

        DB::beginTransaction();
        try {

            foreach ($validation['experiences'] as $experience) {

                $user->experiences()->updateOrCreate(
                    [
                        'id' => $experience['id'],
                    ],
                    [
                        'job_title' => $experience['job_title'],
                        'employeer' => $experience['employeer'],
                        'city' => $experience['city'],
                        'country' => $experience['country'],
                        'start_date' => $experience['start_date'],
                        'end_date' => $experience['end_date'],
                        'description' => $experience['description'],
                    ]
                );
            }

            DB::commit();
            return redirect()->route('user.profile.show', $user)->with('success', 'Experience Updated Successfully');
            
        } catch (Exception $e) {

            DB::rollBack();
            return back()->with('error', 'something went wrong');
        }

    }
}
