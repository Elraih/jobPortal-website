<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function create(){
        return Inertia::render('Auth/Login');
    }

    public function store(Request $request){

        $validated = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);
        
        if(Auth::attempt($validated)){
            return redirect()->intended('home');
        }

        
        return back()->withErrors('error', 'wrong email or password');
    }
}
