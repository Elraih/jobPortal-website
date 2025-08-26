<?php

use App\Http\Controllers\Auth\ResetPassword;
use Illuminate\Support\Facades\Route;



Route::get('/reset-password/{token}', [ResetPassword::class, 'show'])->name('password.reset');

Route::post('/reset-password', [ResetPassword::class, 'reset'])->name('password.reset');