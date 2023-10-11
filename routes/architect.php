<?php

use Illuminate\Support\Facades\Route;

Route::get('/signup', function(){
	return view('users.pages.architect.auth.signup');
})->name('signup');

Route::get('/login', function(){
	echo "hello";
})->name('login');
