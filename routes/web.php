<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// main page for anyone can view 
Route::get('/', [HomeController::class, 'index'])->name('home');
    
//auth route 
require 'auth.php';

require 'resetPassword.php';

require 'forgetPassword.php';

require 'verifyEmail.php';

// jobSeeker route 
require 'jobSeeker.php';

//admin rout
require 'admin.php';

//company route
require 'company.php';












