<?php

use App\Http\Controllers\Company\AccountController;
use App\Http\Controllers\Company\DashboardController;
use App\Http\Controllers\Company\JobApplicationController;
use App\Http\Controllers\Company\JobPostController;
use App\Http\Controllers\Company\ProfileController;
use App\Http\Controllers\Company\UserController;
use Illuminate\Support\Facades\Route;


Route::prefix('company')->middleware(['auth','company', 'verified'])->name('company.')->group(function(){

    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::prefix('/jobs')->name('jobs.')->group(function(){

        Route::post('/store', [JobPostController::class, 'store'])->name('store'); 

        Route::get('/', [JobPostController::class, 'index'])->name('index');

        Route::get('/trashed', [JobPostController::class, 'trashed'])->name('trashed');
        
        Route::get('/create', [JobPostController::class, 'create'])->name('create');
       
        Route::get('/{jobPost}/edit', [JobPostController::class, 'edit'])->name('edit');

        Route::delete('/{jobPost}', [JobPostController::class, 'softDelete'])->name('softDelete');

        Route::put('/{jobPost}/update', [JobPostController::class, 'update'])->name('update');

        Route::get('/{slug}', [JobPostController::class, 'show'])->name('show');
    });

    Route::prefix('/job-applications')->name('job-applications.')->group(function(){

        Route::get('/{jobPost}/job', [JobApplicationController::class, 'index'])->name('index');

        Route::patch('/{jobApplication}/job', [JobApplicationController::class, 'reviewApplication'])->name('reviewApplication');
                
        Route::get('/show', [JobApplicationController::class, 'show'])->name('show');

        Route::get('/{jobApplication}/downloadResume', [JobApplicationController::class, 'downloadResume'])->name('downloadResume');
    });

    Route::prefix('/user')->name('user.')->group(function(){

        Route::get('/{user}', [UserController::class, 'show'])->name('show');
    });


    Route::prefix('/profile')->name('profile.')->group(function(){
        
        Route::get('/{user}', [ProfileController::class, 'show'])->name('show');

        Route::get('/{user}/edit', [ProfileController::class, 'edit'])->name('edit')->can('view', 'user');

        Route::post('/{user}/update', [ProfileController::class, 'update'])->name('update');

        Route::delete('/{user}/delete-logo', [ProfileController::class, 'deleteLogo'])->name('deleteLogo');

    });

    Route::prefix('/account')->name('account.')->group(function(){

        Route::get('/{user}/edit', [AccountController::class, 'edit'])->name('edit');

        Route::patch('/{user}/update-password', [AccountController::class, 'updatePassword'])->name('update.password');

        Route::patch('/{user}/update-email', [AccountController::class, 'updateEmail'])->name('update.email');

        Route::delete('/{user}/destroy', [AccountController::class, 'destroy'])->name('destroy');
    });
   
});
