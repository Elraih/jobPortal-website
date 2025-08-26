<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AccountController extends Controller
{
    // show edit account page 
    public function edit(User $user)
    {

        return Inertia::render('User/Account/Edit', ['user' => $user]);
    }

    // reset password 
    public function updatePassword(Request $request, User $user)
    {

        $validation = $request->validate([
            'password' => ['required', 'current_password'],
            'newPassword' => ['required', 'confirmed'],
        ]);

        $user->update([
            'password' => $request->newPassword,
        ]);

        return redirect()->back()->with('success', 'Your Account Has Been Updated');
    }

    // reset email 
    public function updateEmail(Request $request, User $user)
    {

        $validation = $request->validate([
            'newEmail' => ['required', 'email', 'confirmed'],
        ]);

        $user->update([
            'newEmail' => $request->password,
        ]);

        return redirect()->back()->with('success', 'Your Account Has Been Updated');
    }


    // soft delete user account 
    public function destroy(User $user)
    {

        $avatar = $user->userProfile->avatar;
        $resume = $user->resume->resume;

        // delete user avatar from from storage 
        if ($avatar && Storage::disk('public')->exists($avatar)) {
            Storage::disk('public')->delete($avatar);
        }

        // delete user resume from from storage 
        if ($resume && Storage::disk('public')->exists($resume)) {
            Storage::disk('public')->delete($resume);
        }

        // delete user resume raw from database 
        $user->resume()->delete();
        // assign avatar to null but keep user data for appliaction refrences
        $user->userProfile()->update(['avatar' => null]);

        $user->delete();
    }
}
