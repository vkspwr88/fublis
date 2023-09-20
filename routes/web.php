<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('users.pages.home');
})->name('home');

Route::get('/privacy-policy', function () {
    return view('users.pages.privacy-policy');
})->name('privacy-policy');

Route::get('/blank', function () {
    return view('users.pages.blank');
})->name('blank');

Route::get('/blogs', function () {
    return view('users.pages.blogs.index', [
		'category' => [
			[
				'id' => 1,
				'name' => 'Resources',
				'slug' => 'resources'
			],
			[
				'id' => 2,
				'name' => 'Interviews',
				'slug' => 'interviews'
			]
		],
		'industry' => [
			[
				'id' => 1,
				'name' => 'Architecture',
				'slug' => 'architecture'
			],
			[
				'id' => 2,
				'name' => 'Home Decor',
				'slug' => 'home-decor'
			]
		]
	]);
})->name('blogs.index');

Route::get('/blogs/blog', function () {
    return view('users.pages.blogs.show');
})->name('blogs.show');
