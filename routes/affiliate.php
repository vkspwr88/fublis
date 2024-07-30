<?php

use App\Http\Controllers\Affiliates;
use App\Http\Middleware\JournalistLogin;
use App\Http\Middleware\RegisterredForAffiliate;
use Illuminate\Support\Facades\Route;

Route::middleware(JournalistLogin::class)->group(function() {
	Route::get('/register', [Affiliates\RegisterController::class, 'index'])->name('register');
	Route::get('/register/{affRegistration}', [Affiliates\RegisterController::class, 'status'])->name('register.status');
	Route::middleware(RegisterredForAffiliate::class)->group(function() {
		Route::get('/dashboard', function(){
			return view('users.pages.affiliates.dashboard');
		})->name('dashboard');
		Route::get('/urls', function(){
			return view('users.pages.affiliates.urls');
		})->name('urls');
		Route::get('/stats', function(){
			return view('users.pages.affiliates.stats');
		})->name('stats');
		Route::get('/graphs', function(){
			return view('users.pages.affiliates.graphs');
		})->name('graphs');
		Route::get('/referrals', function(){
			return view('users.pages.affiliates.referrals');
		})->name('referrals');
		Route::get('/payouts', function(){
			return view('users.pages.affiliates.payouts');
		})->name('payouts');
		Route::get('/visits', function(){
			return view('users.pages.affiliates.visits');
		})->name('visits');
	});
});
