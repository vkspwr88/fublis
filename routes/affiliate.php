<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function(){
	return view('users.pages.affiliates.dashboard');
})->name('dashboard');
