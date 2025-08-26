<?php

use App\Http\Controllers\Auth\VerifyAccount;
use Illuminate\Support\Facades\Route;



Route::get('/email/verify/{id}/{hash}', [VerifyAccount::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', [VerifyAccount::class, 'resend'])->name('verification.send');

Route::get('/email/verification-notification',[VerifyAccount::class, 'notice'])->name('verification.notice');