<?php

use Illuminate\Support\Facades\Route;

Route::get('/register', function(){
	return view('users.pages.affiliates.register');
})->name('register');
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
