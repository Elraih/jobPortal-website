<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function show(User $user)
    {
       
        return Inertia::render('Admin/Profile/Show', ['user' => $user]);
    }

    public function edit()
    {
       
        return Inertia::render('Admin/Profile/Edit');
    }
}
