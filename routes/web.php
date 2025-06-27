<?php

use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;
use App\Http\Controllers\Admin\JobApplicationController as AdminJobApplicationController;
use App\Http\Controllers\Admin\JobPostController as AdminJobPostController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Company\CompanyController as CompanyCompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Company\JobApplicationController as CompanyJobApplicationController;
use App\Http\Controllers\Company\JobPostController as CompanyJobPostController;
use App\Http\Controllers\Company\ProfileController as CompanyProfileController;
use App\Http\Controllers\Company\UserController;
use App\Http\Controllers\User\JobApplicationController as UserJobApplicationController;
use App\Http\Controllers\User\JobPostController as UserJobPostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\User\CompanyController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// main page for anyone can view 
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('/user')->name('user.')->middleware('guest')->group(function(){

    Route::prefix('/jobs')->name('jobs.')->group(function(){

        Route::get('/', [UserJobPostController::class, 'index'])->name('index');
        
        Route::get('/create', [UserJobPostController::class, 'create'])->name('create');
        
        Route::post('/create', [UserJobPostController::class, 'store'])->name('store'); 

        Route::get('/{id}', [UserJobPostController::class, 'show'])->name('show');
    });

    Route::prefix('/job-applications')->group(function(){

        Route::get('/', [UserJobApplicationController::class, 'index'])->name('index');
        
        Route::get('/create', [UserJobApplicationController::class, 'create'])->name('create');
        
        Route::post('/create', [UserJobApplicationController::class, 'store'])->name('store'); 

        Route::get('/{id}', [UserJobApplicationController::class, 'show'])->name('show');
    });

    Route::prefix('/company')->group(function(){

        Route::get('/', [CompanyController::class, 'index'])->name('index');
        
        Route::get('/create', [CompanyController::class, 'create'])->name('create');
        
        Route::post('/create', [CompanyController::class, 'store'])->name('store'); 

        Route::get('/{id}', [CompanyController::class, 'show'])->name('show');
    });

    Route::prefix('/user')->group(function(){

        Route::get('/', [ProfileController::class, 'index'])->name('index');
        
        Route::get('/create', [ProfileController::class, 'create'])->name('create');
        
        Route::post('/create', [ProfileController::class, 'store'])->name('store'); 

        Route::get('/{id}', [ProfileController::class, 'show'])->name('show');
    });

});

//auth route 
Route::prefix('auth')->name('auth.')->group(function(){

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    
    Route::get('/register-as-company', [RegisterController::class, 'registerAsCompany'])->name('registerAsCompany');
    Route::get('/register-as-jobseeker', [RegisterController::class, 'registerAsJobSeeker'])->name('registerAsJobseeker');
    Route::post('/register', [RegisterController::class, 'store']); 
   
});

// job posts route 
Route::prefix('admin')->group(function(){

    Route::prefix('/jobs')->group(function(){

        Route::get('/', [AdminJobPostController::class, 'index']);
        
        Route::get('/create', [AdminJobPostController::class, 'create']);
        
        Route::post('/create', [AdminJobPostController::class, 'store']); 

        Route::get('/{id}', [AdminJobPostController::class, 'show']);
    });

    Route::prefix('/job-applications')->group(function(){

        Route::get('/', [AdminJobApplicationController::class, 'index'])->name('index');
        
        Route::get('/create', [AdminJobApplicationController::class, 'create'])->name('create');
        
        Route::post('/create', [AdminJobApplicationController::class, 'store'])->name('store'); 

        Route::get('/{id}', [AdminJobApplicationController::class, 'show'])->name('show');
    });

    Route::prefix('/company')->group(function(){

        Route::get('/', [AdminCompanyController::class, 'index'])->name('index');
        
        Route::get('/create', [AdminCompanyController::class, 'create'])->name('create');
        
        Route::post('/create', [AdminCompanyController::class, 'store'])->name('store'); 

        Route::get('/{id}', [AdminCompanyController::class, 'show'])->name('show');
    });

    Route::prefix('/user')->group(function(){

        Route::get('/', [AdminProfileController::class, 'index'])->name('index');
        
        Route::get('/create', [AdminProfileController::class, 'create'])->name('create');
        
        Route::post('/create', [AdminProfileController::class, 'store'])->name('store'); 

        Route::get('/{id}', [AdminProfileController::class, 'show'])->name('show');
    });
   
});

Route::prefix('company')->group(function(){

    Route::prefix('/jobs')->group(function(){

        Route::get('/', [CompanyJobPostController::class, 'index'])->name('index');
        
        Route::get('/create', [CompanyJobPostController::class, 'create'])->name('create');
        
        Route::post('/create', [CompanyJobPostController::class, 'store'])->name('store'); 

        Route::get('/{id}', [CompanyJobPostController::class, 'show'])->name('show');
    });

    Route::prefix('/job-applications')->group(function(){

        Route::get('/', [CompanyJobApplicationController::class, 'index']);
                
        Route::get('/{id}', [CompanyJobApplicationController::class, 'show']);
    });

    Route::prefix('/user')->group(function(){

        Route::get('/', [UserController::class, 'index'])->name('index');
        
        Route::get('/create', [UserController::class, 'create'])->name('create');
        
        Route::post('/create', [UserController::class, 'store'])->name('store'); 

        Route::get('/{id}', [UserController::class, 'show'])->name('show');
    });

    Route::prefix('/profile')->group(function(){
        
        Route::get('/{id}', [CompanyProfileController::class, 'show']);

        Route::get('/{id}/edit', [CompanyProfileController::class, 'edit']);
        

    });
   
});






