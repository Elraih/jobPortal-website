<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobApplicationController;
use App\Http\Controllers\Admin\JobPostController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->middleware(['admin', 'auth'])->name('admin.')->group(function(){

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/jobs')->name('jobs.')->group(function(){

        Route::get('/', [JobPostController::class, 'index'])->name('index');

        Route::get('/{slug}/show', [JobPostController::class, 'show'])->name('show'); 
        
        Route::delete('/{jobPost}', [JobPostController::class, 'softDelete'])->name('delete');

        Route::get('/trashed', [JobPostController::class, 'trashed'])->name('trashed');
        
    });

    Route::prefix('/job-applications')->name('job-applications.')->group(function(){

        Route::get('/', [JobApplicationController::class, 'index'])->name('index');

        Route::get('/{id}', [JobApplicationController::class, 'show'])->name('show');


    });

    Route::prefix('/company')->name('company.')->group(function(){

        Route::get('/', [CompanyController::class, 'index'])->name('index');
        
        Route::get('/{user}/show', [CompanyController::class, 'show'])->name('show');

        Route::delete('/{user}', [CompanyController::class, 'softDelete'])->name('delete');

        Route::get('/trashed', [CompanyController::class, 'trashed'])->name('trashed');

    });

    Route::prefix('/user')->name('user.')->group(function(){

        Route::get('/', [UserController::class, 'index'])->name('index'); 

        Route::get('/{user}/show', [UserController::class, 'show'])->name('show');

        Route::delete('/{user}', [UserController::class, 'softDelete'])->name('delete');

        Route::get('/trashed', [UserController::class, 'trashed'])->name('trashed');

    });

    Route::prefix('/profile')->name('profile.')->group(function(){

        
        Route::get('/{user}', [ProfileController::class, 'show'])->name('show');

        Route::get('/{user}/edit', [ProfileController::class, 'edit'])->name('edit'); 

        Route::patch('/{user}/update-password', [ProfileController::class, 'updatePassword'])->name('update.password'); 

        Route::patch('/{user}/update-email', [ProfileController::class, 'updateEmail'])->name('update.email'); 
    });
   
});