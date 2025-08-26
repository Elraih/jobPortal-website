<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class LoginController extends Controller
{
    // show login page 
    public function create()
    {

        return Inertia::render('Auth/Login');
    }

    //  login form attempts check and redirect to 
    public function store(Request $request)
    {

        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required' ]
        ]);

        if (Auth::attempt($validated)) {

            $request->session()->regenerate();

            if (Auth::user()->role == 'job_seeker') return redirect()->intended('/')->with('success', 'Welcom Back');
            if (Auth::user()->role == 'company') return redirect()->intended('/company/dashboard')->with('success', 'Welcom Back');
            if (Auth::user()->role == 'admin') return redirect()->intended('/admin/dashboard')->with('success', 'Welcom Back');
        }

        return back()->with('error', 'wrong email or password');
    }


    // logout  and reset session redirect to login page
    public function logout(Request $request)
    {

        Auth::logout();

        // delete session row from database after loging out 
        DB::table('sessions')->where('id', $request->session()->getId())->delete();

        // regenrate session 
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
