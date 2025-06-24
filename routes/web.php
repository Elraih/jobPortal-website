<?php

use App\Http\Controllers\Admin\JobApplicationController as AdminJobApplicationController;
use App\Http\Controllers\Admin\JobPostController as AdminJobPostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Employer\JobApplicationController as EmployerJobApplicationController;
use App\Http\Controllers\Employer\JobPostController as EmployerJobPostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobPostController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// main page for anyone can view 
Route::get('/', [HomeController::class, 'index'])->name('users.index');

//auth route 
Route::prefix('auth')->group(function(){

    Route::get('/login', [JobPostController::class, 'create'])->name('login');
    Route::post('/login', [JobPostController::class, 'store']);
    
    Route::get('/register', [JobPostController::class, 'create'])->name('register');
    Route::post('/register', [JobPostController::class, 'store']); 
   
});

// job posts route 
Route::prefix('admin')->group(function(){

    Route::prefix('/jobs')->group(function(){

        Route::get('/', [AdminJobPostController::class, 'index'])->name('index');
        
        Route::get('/create', [AdminJobPostController::class, 'create'])->name('create');
        
        Route::post('/create', [AdminJobPostController::class, 'store'])->name('store'); 

        Route::get('/{id}', [AdminJobPostController::class, 'show'])->name('show');
    });

    Route::prefix('/job-applications')->group(function(){

        Route::get('/', [AdminJobApplicationController::class, 'index'])->name('index');
        
        Route::get('/create', [AdminJobApplicationController::class, 'create'])->name('create');
        
        Route::post('/create', [AdminJobApplicationController::class, 'store'])->name('store'); 

        Route::get('/{id}', [AdminJobApplicationController::class, 'show'])->name('show');
    });

    Route::prefix('/company')->group(function(){

        Route::get('/', [JobPostController::class, 'index'])->name('index');
        
        Route::get('/create', [JobPostController::class, 'create'])->name('create');
        
        Route::post('/create', [JobPostController::class, 'store'])->name('store'); 

        Route::get('/{id}', [JobPostController::class, 'show'])->name('show');
    });

    Route::prefix('/user')->group(function(){

        Route::get('/', [JobPostController::class, 'index'])->name('index');
        
        Route::get('/create', [JobPostController::class, 'create'])->name('create');
        
        Route::post('/create', [JobPostController::class, 'store'])->name('store'); 

        Route::get('/{id}', [JobPostController::class, 'show'])->name('show');
    });
   
});

Route::prefix('company')->group(function(){

    Route::prefix('/jobs')->group(function(){

        Route::get('/', [EmployerJobPostController::class, 'index'])->name('index');
        
        Route::get('/create', [EmployerJobPostController::class, 'create'])->name('create');
        
        Route::post('/create', [EmployerJobPostController::class, 'store'])->name('store'); 

        Route::get('/{id}', [EmployerJobPostController::class, 'show'])->name('show');
    });

    Route::prefix('/job-applications')->group(function(){

        Route::get('/', [EmployerJobApplicationController::class, 'index'])->name('index');
        
        Route::get('/create', [EmployerJobApplicationController::class, 'create'])->name('create');
        
        Route::post('/create', [EmployerJobApplicationController::class, 'store'])->name('store'); 

        Route::get('/{id}', [EmployerJobApplicationController::class, 'show'])->name('show');
    });

    Route::prefix('/company')->group(function(){

        Route::get('/', [JobPostController::class, 'index'])->name('index');
        
        Route::get('/create', [JobPostController::class, 'create'])->name('create');
        
        Route::post('/create', [JobPostController::class, 'store'])->name('store'); 

        Route::get('/{id}', [JobPostController::class, 'show'])->name('show');
    });

    Route::prefix('/user')->group(function(){

        Route::get('/', [JobPostController::class, 'index'])->name('index');
        
        Route::get('/create', [JobPostController::class, 'create'])->name('create');
        
        Route::post('/create', [JobPostController::class, 'store'])->name('store'); 

        Route::get('/{id}', [JobPostController::class, 'show'])->name('show');
    });
   
});

Route::prefix('user')->group(function(){

    Route::prefix('/jobs')->group(function(){

        Route::get('/', [\App\Http\Controllers\User\JobPostController::class, 'index'])->name('index');
        
        Route::get('/create', [\App\Http\Controllers\User\JobPostController::class, 'create'])->name('create');
        
        Route::post('/create', [\App\Http\Controllers\User\JobPostController::class, 'store'])->name('store'); 

        Route::get('/{id}', [\App\Http\Controllers\User\JobPostController::class, 'show'])->name('show');
    });

    Route::prefix('/job-applications')->group(function(){

        Route::get('/', [\App\Http\Controllers\User\JobApplicationController::class, 'index'])->name('index');
        
        Route::get('/create', [\App\Http\Controllers\User\JobApplicationController::class, 'create'])->name('create');
        
        Route::post('/create', [\App\Http\Controllers\User\JobApplicationController::class, 'store'])->name('store'); 

        Route::get('/{id}', [\App\Http\Controllers\User\JobApplicationController::class, 'show'])->name('show');
    });

    Route::prefix('/company')->group(function(){

        Route::get('/', [JobPostController::class, 'index'])->name('index');
        
        Route::get('/create', [JobPostController::class, 'create'])->name('create');
        
        Route::post('/create', [JobPostController::class, 'store'])->name('store'); 

        Route::get('/{id}', [JobPostController::class, 'show'])->name('show');
    });

    Route::prefix('/user')->group(function(){

        Route::get('/', [JobPostController::class, 'index'])->name('index');
        
        Route::get('/create', [JobPostController::class, 'create'])->name('create');
        
        Route::post('/create', [JobPostController::class, 'store'])->name('store'); 

        Route::get('/{id}', [JobPostController::class, 'show'])->name('show');
    });
   
});



// job posts route 
Route::prefix('jobs')->name('jobs.')->group(function(){

    Route::get('/', [JobPostController::class, 'index'])->name('index');
    
    Route::get('/create', [JobPostController::class, 'create'])->name('create');
    
    Route::post('/create', [JobPostController::class, 'store'])->name('store'); 

    Route::get('/{id}', [JobPostController::class, 'show'])->name('show');
   
});

Route::prefix('job-applications')->name('job-applications.')->group(function(){

    Route::get('/', [JobApplicationController::class, 'index'])->name('index');

    Route::post('/store', [JobApplicationController::class, 'store'])->name('store');

});


Route::prefix('profile')->name('profile.')->group(function(){

    Route::get('/', [JobApplicationController::class, 'index'])->name('index');
    
    Route::post('/store', [JobApplicationController::class, 'store'])->name('store');
    
    Route::get('/edit', [JobApplicationController::class, 'edit'])->name('edit');
    
    Route::put('/update', [JobApplicationController::class, 'update'])->name('update');
});

Route::prefix('settings')->name('settings.')->group(function(){

    Route::get('/', [JobApplicationController::class, 'index'])->name('index');
    
    Route::post('/store', [JobApplicationController::class, 'store'])->name('store');
    
    Route::get('/edit', [JobApplicationController::class, 'edit'])->name('edit');
    
    Route::put('/update', [JobApplicationController::class, 'update'])->name('update');
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

Route::get('/login', function(){
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


