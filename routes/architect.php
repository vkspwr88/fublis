<?php

use Illuminate\Support\Facades\Route;

Route::get('/signup', function(){
	return view('users.pages.architect.auth.signup');
})->name('signup');

Route::get('/login', function(){
	echo "hello";
})->name('login');

//Route::group('add-story')
Route::name('add-story.')->prefix('add-story')->group(function () {
    Route::get('/', function(){
		return view('users.pages.architect.add-story.index');
	})->name('index');
	Route::get('/press-release', function(){
		return view('users.pages.architect.add-story.press-release');
	})->name('press-release');
	Route::get('/article', function(){
		return view('users.pages.architect.add-story.article');
	})->name('article');
	Route::get('/project', function(){
		return view('users.pages.architect.add-story.project');
	})->name('project');
});

