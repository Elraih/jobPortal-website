<?php

use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\CompanyController;
use App\Http\Controllers\User\EditExperienceController;
use App\Http\Controllers\User\EditInfoController;
use App\Http\Controllers\User\EditSkillController;
use App\Http\Controllers\User\EducationController;
use App\Http\Controllers\User\JobApplicationController;
use App\Http\Controllers\User\JobPostController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ResumeController;
use Illuminate\Support\Facades\Route;


Route::prefix('/user')->middleware(['auth','verified','jobseeker'])->name('user.')->group(function(){

    Route::prefix('/jobs')->name('jobs.')->group(function(){

        Route::get('/', [JobPostController::class, 'index'])->name('index')->withoutMiddleware(['auth','verified','jobseeker']);
    
        Route::get('/{slug}', [JobPostController::class, 'show'])->name('show')->withoutMiddleware(['auth','verified','jobseeker']);

        Route::post('/{jobPost}', [JobPostController::class, 'apply'])->name('apply');
    });

    Route::prefix('/job-applications')->name('job-applications.')->group(function(){

        Route::get('/', [JobApplicationController::class, 'index'])->name('index');
        
        Route::post('/create', [JobApplicationController::class, 'store'])->name('store'); 

    });

    Route::prefix('/resume')->name('resume.')->group(function(){

        Route::get('/{resume}', [ResumeController::class, 'downloadResume'])->name('downloadResume');
        
    });

    Route::prefix('/company')->name('company.')->group(function(){

        // Route::get('/', [CompanyController::class, 'index'])->name('index');

        Route::get('/{user}', [CompanyController::class, 'show'])->name('show');
    });

    Route::prefix('/account')->name('account.')->group(function(){

        Route::get('/{user}/edit', [AccountController::class, 'edit'])->name('edit');

        Route::patch('/{user}/update-password', [AccountController::class, 'updatePassword'])->name('update.password');

        Route::patch('/{user}/update-email', [AccountController::class, 'updateEmail'])->name('update.email');

        Route::delete('/{user}/destroy', [AccountController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/profile')->name('profile.')->group(function(){
        
        Route::get('/{user}', [ProfileController::class, 'show'])->name('show');
        Route::delete('/{user}', [ProfileController::class, 'deleteAvatar'])->name('deleteAvatar');
        
        Route::get('/{user}/edit-experience', [EditExperienceController::class, 'editExperience'])->name('editExperience'); 
        Route::post('/{user}/edit-experience', [EditExperienceController::class, 'updateExperience'])->name('editExperience'); 
        Route::delete('/{experience}/edit-experience', [EditExperienceController::class, 'deleteExperience'])->name('deleteExperience'); 

        
        Route::get('/{user}/edit-info', [EditInfoController::class, 'editInfo'])->name('editInfo'); 
        Route::post('/{user}/edit-info', [EditInfoController::class, 'updateInfo'])->name('editInfo'); 
        
        Route::get('/{user}/edit-education', [EducationController::class, 'editEducation'])->name('editEducation'); 
        Route::post('/{user}/edit-education', [EducationController::class, 'updateEducation'])->name('editEducation'); 
        Route::delete('/{education}/edit-education', [EducationController::class, 'deleteEducation'])->name('deleteEducation'); 

        Route::get('/{user}/edit-skills', [EditSkillController::class, 'editSkills'])->name('editSkills'); 
        Route::post('/{user}/edit-skills', [EditSkillController::class, 'updateSkills'])->name('editSkills'); 

    });

});