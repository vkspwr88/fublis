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

Route::get('/blank', function () {
    return view('users.pages.blank');
})->name('blank');

Route::get('/blogs', function () {
    return view('users.pages.blogs.index');
})->name('blogs');

Route::get('/blog', function () {
    return view('users.pages.blogs.view');
})->name('blog');
