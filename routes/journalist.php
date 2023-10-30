<?php

use App\Http\Controllers\Users\Journalists;
use App\Http\Middleware\JournalistLogin;
use Illuminate\Support\Facades\Route;

Route::get('/signup', [Journalists\Auth\SignupController::class, 'index'])->name('signup');
Route::get('/login', [Journalists\Auth\LoginController::class, 'index'])->name('login');
Route::get('/logout', [Journalists\Auth\LogoutController::class, 'index'])->name('logout');
