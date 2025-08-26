<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Inertia\Inertia;

class AccountController extends Controller
{

    // show company's account form 
    public function edit(User $user)
    {

        return Inertia::render('Company/Account/Edit', ['company' => $user]);
    }


    // reset passwrod 
    public function updatePassword(Request $request, User $user)
    {

        $validation = $request->validate([
            'password' => ['required', 'current_password'],
            'newPassword' => ['required', 'confirmed'],
        ]);

        $user->update([
            'password' => $request->password,
        ]);

        return redirect()->back()->with('success', 'Your Password Has Been Updated');
    }


    // reset email 
    public function updateEmail(Request $request, User $user)
    {

        $validation = $request->validate([
            'newEmail' => ['required', 'confirmed', 'unique:users,email']
        ]);

        $user->update([
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Your Email Has Been Updated');
    }


    // delete company's account 
    public function destroy(User $user)
    {

        $user->jobPosts()->update([
            'application_deadline' => Date::now(),
            'status' => 'closed'
        ]);

        $user->delete();
    }
}
