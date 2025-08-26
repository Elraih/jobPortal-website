<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Inertia\Inertia;

class ResetPassword extends Controller
{
    // show reset password page 
    public function show($token)
    {
        return Inertia::render('Auth/ResetPassword', [
            'token' => $token,
        ]);
    }

    // store the new password  
    public function reset(Request $request)
    {

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            fn($user, $password) => $user->forceFill(['password' => $password])->save()
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', $status)
            : redirect()->back()->with('error', $status);
    }
}
