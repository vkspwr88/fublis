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
		Route::get('/', [Journalists\MediaKitController::class, 'index'])->name('index');
		Route::name('press-release.')->prefix('press-release')->group(function () {
			Route::get('/{mediaKit}', [Journalists\MediaKits\PressReleaseController::class, 'view'])->name('view');
		});
		Route::name('article.')->prefix('article')->group(function () {
			Route::get('/{mediaKit}', [Journalists\MediaKits\ArticleController::class, 'view'])->name('view');
		});
		Route::name('project.')->prefix('project')->group(function () {
			Route::get('/{mediaKit}', [Journalists\MediaKits\ProjectController::class, 'view'])->name('view');
		});
		//Route::get('/{mediaKit}', [Journalists\MediaKitController::class, 'view'])->name('view');
	});

	Route::name('brand.')->prefix('brand')->group(function () {
		Route::get('/', [Journalists\BrandController::class, 'index'])->name('index');
	});

	Route::name('submission.')->prefix('submission')->group(function () {
		Route::get('/', [Journalists\SubmissionController::class, 'index'])->name('index');
	});


});
