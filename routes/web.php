<?php

use App\Http\Controllers\Users;
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

/* Route::get('/email', function () {
    return (new VerifySubscriber())->render();
})->name('email'); */

Route::get('/blogs', [Users\BlogController::class, 'index'])->name('blogs.index');
Route::get('/newsletter/subscribe/{token}', [Users\SubscribeNewsletterController::class, 'verify'])->name('subscribe.newsletter.verify');

Route::get('/blogs/{slug}', [Users\BlogController::class, 'show'])->name('blogs.show');
