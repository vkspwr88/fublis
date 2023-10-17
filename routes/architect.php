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

Route::name('media-kit.')->prefix('media-kit')->group(function () {
    Route::get('/', function(){
		return view('users.pages.architect.media-kit.index', [
			'categories' => array(),
			'mediaKitTypes' => array(),
		]);
	})->name('index');
	Route::get('/press-release/{id}', function(){
		return view('users.pages.architect.media-kit.press-release.view');
	})->name('press-release.view');
	Route::get('/press-release/{id}/edit', function(){
		return view('users.pages.architect.media-kit.press-release.edit');
	})->name('press-release.edit');
	Route::get('/article/{id}', function(){
		return view('users.pages.architect.media-kit.article.view');
	})->name('article.view');
	Route::get('/article/{id}/edit', function(){
		return view('users.pages.architect.media-kit.article.edit');
	})->name('article.edit');
	Route::get('/project/{id}', function(){
		return view('users.pages.architect.media-kit.project.view');
	})->name('project.view');
	Route::get('/project/{id}/edit', function(){
		return view('users.pages.architect.media-kit.project.edit');
	})->name('project.edit');
});

Route::name('pitch-story.')->prefix('pitch-story')->group(function () {
    Route::get('/', function(){
		return view('users.pages.architect.pitch-story.publication', [
			'categories' => array(),
			'publicationTypes' => array(),
		]);
	})->name('index');
	Route::get('/publications', function(){
		return view('users.pages.architect.pitch-story.publication', [
			'categories' => array(),
			'publicationTypes' => array(),
		]);
	})->name('publications');
	Route::get('/journalists', function(){
		return view('users.pages.architect.pitch-story.journalist', [
			'categories' => array(),
			'publicationTypes' => array(),
			'roleTypes' => array(),
		]);
	})->name('journalists');
	Route::get('/calls', function(){
		return view('users.pages.architect.pitch-story.call', [
			'categories' => array(),
			'publicationTypes' => array(),
		]);
	})->name('calls');
});

