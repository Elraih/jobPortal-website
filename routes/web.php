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

        Route::get('/{id}', [UserJobPostController::class, 'show'])->name('show');
    });

    Route::prefix('/job-applications')->name('job-applications.')->group(function(){

        Route::get('/', [UserJobApplicationController::class, 'index'])->name('index');
        
        Route::post('/create', [UserJobApplicationController::class, 'store'])->name('store'); 

    });

    Route::prefix('/company')->name('company.')->group(function(){

        Route::get('/', [CompanyController::class, 'index'])->name('index');

        Route::get('/show', [CompanyController::class, 'show'])->name('show');
    });

    Route::prefix('/profile')->name('profile.')->group(function(){
        
        Route::get('/show', [ProfileController::class, 'show'])->name('show');
        
        Route::post('/create', [ProfileController::class, 'store'])->name('store'); 

    });

});

//auth route 
Route::prefix('auth')->name('auth.')->group(function(){

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    
    Route::get('/register-as-company', [RegisterController::class, 'registerAsCompany'])->name('registerAsCompany');
    Route::get('/register-as-jobseeker', [RegisterController::class, 'registerAsJobSeeker'])->name('registerAsJobSeeker');
    Route::post('/register-as-company', [RegisterController::class, 'storeAsCompany'])->name('storeAsCompany'); 
    Route::post('/register-as-jobseeker', [RegisterController::class, 'storeAsJobSeeker'])->name('storeAsJobSeeker'); 
   
});

// job posts route 
Route::prefix('admin')->name('admin.')->group(function(){

    Route::prefix('/jobs')->name('jobs.')->group(function(){

        Route::get('/', [AdminJobPostController::class, 'index'])->name('index');

        Route::get('/{id}', [AdminJobPostController::class, 'show'])->name('show');
    });

    Route::prefix('/job-applications')->name('job-applications.')->group(function(){

        Route::get('/', [AdminJobApplicationController::class, 'index'])->name('index');

        Route::get('/{id}', [AdminJobApplicationController::class, 'show'])->name('show');
    });

    Route::prefix('/company')->name('company.')->group(function(){

        Route::get('/', [AdminCompanyController::class, 'index'])->name('index');
        
        Route::get('/{id}', [AdminCompanyController::class, 'show'])->name('show');
    });

    Route::prefix('/user')->name('user.')->group(function(){

        Route::get('/', [AdminProfileController::class, 'index'])->name('index'); 

        Route::get('/{id}', [AdminProfileController::class, 'show'])->name('show');
    });
   
});

Route::prefix('company')->name('company.')->group(function(){

    Route::prefix('/jobs')->name('jobs.')->group(function(){

        Route::get('/', [CompanyJobPostController::class, 'index'])->name('index');
        
        Route::get('/create', [CompanyJobPostController::class, 'create'])->name('create');
       
        Route::get('/edit', [CompanyJobPostController::class, 'edit'])->name('edit');

        Route::post('/create', [CompanyJobPostController::class, 'store'])->name('store'); 

        Route::get('/{id}', [CompanyJobPostController::class, 'show'])->name('show');
    });

    Route::prefix('/job-applications')->name('job-applications.')->group(function(){

        Route::get('/', [CompanyJobApplicationController::class, 'index'])->name('index');
                
        Route::get('/show', [CompanyJobApplicationController::class, 'show'])->name('show');
    });

    Route::prefix('/user')->name('user.')->group(function(){

        Route::get('/show', [UserController::class, 'show'])->name('show');
    });

    Route::prefix('/profile')->name('profile.')->group(function(){
        
        Route::get('/show', [CompanyProfileController::class, 'show'])->name('show');

        Route::get('/edit', [CompanyProfileController::class, 'edit'])->name('edit');
        

    });
   
});






