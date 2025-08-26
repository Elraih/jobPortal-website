<?php

use App\Http\Controllers\Auth\ForgetPassword;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPassword;
use App\Http\Controllers\Auth\VerifyAccount;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::prefix('auth')->middleware(['guest'])->group(function(){


        Route::get('/login', [LoginController::class, 'create'])->name('login');
        
        Route::post('/login', [LoginController::class, 'store']);


        Route::post('/logout', [LoginController::class, 'logout'])->withoutMiddleware('guest')->name('logout');


    
        Route::get('/register-as-company', [RegisterController::class, 'registerAsCompany'])->name('registerAsCompany');

        Route::get('/register-as-jobseeker', [RegisterController::class, 'registerAsJobSeeker'])->name('registerAsJobSeeker');
       
        Route::post('/register-as-company', [RegisterController::class, 'storeAsCompany'])->name('storeAsCompany'); 
       
        Route::post('/register-as-jobseeker', [RegisterController::class, 'storeAsJobSeeker'])->name('storeAsJobSeeker'); 

});
