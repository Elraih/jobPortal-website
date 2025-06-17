<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [HomeController::class, 'index'])->name('users.index');
Route::get('/jobs', function () {
    return Inertia::render('Jobs/index');
});
Route::get('/job', function () {
    return Inertia::render('Jobs/Show');
});

Route::get('/admin', function () {
    return Inertia::render('Admin/Jobs/Index');
});

Route::get('/dash', function () {
    return Inertia::render('Admin/Index');
});

Route::get('/apply', function () {
    return Inertia::render('Jobs/apply');
});

Route::get('/login', function () {
    return Inertia::render('Auth/Login');
});
Route::get('/company', function () {
    return Inertia::render('Employeer/Profile/Show');
});
Route::get('/companycreate', function () {
    return Inertia::render('Employeer/Profile/Create');
});
Route::get('/user', function () {
    return Inertia::render('User/Profile/Show');
});
Route::get('/editskill', function () {
    return Inertia::render('User/Profile/EditSkills');
});
Route::get('/editinfo', function () {
    return Inertia::render('User/Profile/EditInfo');
});
Route::get('/editex', function () {
    return Inertia::render('User/Profile/EditExperience');
});
Route::get('/jobseeker', function () {
    return Inertia::render('Auth/RegisterJobSeeker');
});


// Route::middleware()->prefix()->group(function(){


// });

Route::get('/contact', [ContactController::class, 'create']);
Route::post('/contact', [ContactController::class, 'store']);


