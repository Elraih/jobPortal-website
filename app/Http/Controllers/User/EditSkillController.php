<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class EditSkillController extends Controller
{

    // show edit user skills page 
    public function editSkills(User $user)
    {

        Gate::authorize('update', $user);

        $user->load(['skill']);
        return Inertia::render(
            'User/Profile/EditSkills',
            [
                'user' => $user
            ]
        );
    }


    // update user skills 
    public function updateSkills(Request $request, User $user)
    {

        $validation = $request->validate([
            'skills' => ['array', 'required', 'max:15'],
        ]);

        $user->skill()->updateOrCreate(
            ['user_id' => $user->id],
            ['skills' => $validation['skills']]
        );

        return redirect()->route('user.profile.show', $user)->with('success', 'your skills has added');
    }
}
