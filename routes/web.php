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

Route::name('auth.')->prefix('auth')->group(function () {
	Route::name('google.')->prefix('google')->controller(Users\Auth\GoogleController::class)->group(function () {
		Route::get('/user/{userType?}', 'index')->name('index');
		Route::get('/callback', 'callback')->name('callback');
	});
});

Route::name('blogs.')->prefix('blogs')->controller(Users\BlogController::class)->group(function () {
	Route::get('/', 'index')->name('index');
	Route::get('/{slug}', 'show')->name('show');
});
// Route::get('/blogs', [Users\BlogController::class, 'index'])->name('blogs.index');
Route::get('/newsletter/subscribe/{token}', [Users\SubscribeNewsletterController::class, 'verify'])->name('subscribe.newsletter.verify');

// Route::get('/blogs/{slug}', [Users\BlogController::class, 'show'])->name('blogs.show');

Route::get('/invitation/{invitation}/{type}', [Users\InvitationController::class, 'index'])->name('invitation');
