<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
       
        return Inertia::render('Admin/User/Index');
    }

    public function show()
    {
       
        return Inertia::render('Admin/User/Show');
    }
}
