<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Inertia\Inertia;

class ForgetPassword extends Controller
{
    public function show(){
        return Inertia::render('Auth/EmailResetLink');
    }


    public function sendResetEmail(Request $request){

        $validation = $request->validate([
            'email' => ['required', 'email'],
        ]);

       $status = Password::sendResetLink($request->only('email'));

       return $status === Password::ResetLinkSent
       ? back()->with('success', $status) 
       : back()->with('error', $status);
       
    }
}
