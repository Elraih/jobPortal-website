<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProfileController extends Controller
{

    // show user profile page and his infos 
    public function show(User $user)
    {

        Gate::authorize('view', $user);

        $user->load(['userProfile', 'contactInfo', 'location', 'educations', 'resume', 'location.governorate', 'skill', 'experiences']);

        return Inertia::render(
            'User/Profile/Show',
            [
                'user' => $user
            ]
        );
    }


    // show edit user info page
    public function edit(User $user)
    {

        Gate::authorize('update', $user);

        return Inertia::render('User/Profile/Edit');
    }

    // delete user avatar 
    public function deleteAvatar(User $user)
    {
        $userProfile = $user->userProfile;

        // delete avatar file from storage 
        if ($userProfile && $userProfile->avatar && Storage::disk('public')->exists($userProfile->avatar)) {
            Storage::disk('public')->delete($userProfile->avatar);
        }

        // update the avatar to null 
        if ($userProfile) {
            $userProfile->update(['avatar' => null]);
        }
    }
}
