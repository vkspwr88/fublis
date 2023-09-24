<?php

use App\Http\Controllers\Users\BlogController;
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

Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');

Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
