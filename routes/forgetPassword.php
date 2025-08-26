<?php

use App\Http\Controllers\Auth\ForgetPassword;
use Illuminate\Support\Facades\Route;



Route::get('/password/forget',[ForgetPassword::class, 'show'])->name('password.reset');

Route::post('/password/forget',[ForgetPassword::class, 'sendResetEmail'])->name('password.sendResetEmail');