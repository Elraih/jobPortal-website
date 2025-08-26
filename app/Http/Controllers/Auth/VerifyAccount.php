<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class VerifyAccount extends Controller
{

    // show verify account link page 
    public function notice(Request $request)
    {

        return Inertia::render('Auth/VerifyAccount');
    }


    // check user virification and redirect to login
    public function verify(EmailVerificationRequest $request)
    {

        $request->fulfill();

        Auth::logout();
        return redirect()->route('login');
    }

    // resend verify account link email 
    public function resend()
    {

        $user = Auth::user();

        if (!$user || $user->hasVerifiedEmail()) {
            return redirect()->route('login');
        }

        $user->notify(new VerifyEmail($user));
    }
}
