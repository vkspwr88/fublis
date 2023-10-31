<?php

use App\Http\Controllers\Users\Journalists;
use App\Http\Middleware\JournalistLogin;
use Illuminate\Support\Facades\Route;

Route::get('/signup', [Journalists\Auth\SignupController::class, 'index'])->name('signup');
Route::get('/login', [Journalists\Auth\LoginController::class, 'index'])->name('login');
Route::get('/logout', [Journalists\Auth\LogoutController::class, 'index'])->name('logout');

Route::middleware(JournalistLogin::class)->group(function() {
	Route::name('call.')->prefix('invite-story')->group(function () {
		Route::get('/', [Journalists\CallController::class, 'index'])->name('index');
		Route::get('/create', [Journalists\CallController::class, 'create'])->name('create');
		Route::get('/{call}/view', [Journalists\CallController::class, 'view'])->name('view');
		Route::get('/{call}/edit', [Journalists\CallController::class, 'edit'])->name('edit');
	});

	Route::name('media-kit.')->prefix('media-kit')->group(function () {
		Route::get('/', [Journalists\CallController::class, 'index'])->name('index');
		//Route::get('/create', [Journalists\CallController::class, 'create'])->name('create');
		//Route::get('/{call}/view', [Journalists\CallController::class, 'view'])->name('view');
		//Route::get('/{call}/edit', [Journalists\CallController::class, 'edit'])->name('view');
		//Route::get('/{success}', [Journalists\CallController::class, 'success'])->name('press-release.success');
		//Route::get('/{success}/edit', [Journalists\CallController::class, 'index'])->name('article');
	});
});
