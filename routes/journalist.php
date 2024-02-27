<?php

use App\Http\Controllers\Users\Journalists;
use App\Http\Controllers\Users\MessageController;
use App\Http\Middleware\JournalistLogin;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
	Route::get('/signup/{step?}', [Journalists\Auth\SignupController::class, 'index'])->name('signup');
	Route::get('/login', [Journalists\Auth\LoginController::class, 'index'])->name('login');
	Route::get('/forgot-password', [Journalists\Auth\ForgotPasswordController::class, 'index'])->name('forgot');
	Route::get('/reset-password/{token}/{email}', [Journalists\Auth\ResetPasswordController::class, 'index'])->name('reset');
});
Route::get('/logout', [Journalists\Auth\LogoutController::class, 'index'])->name('logout');

Route::middleware(JournalistLogin::class)->group(function() {
	Route::post('/download/{mediaKit:slug}', [Journalists\DownloadController::class, 'index'])->name('download');
	Route::post('/download/{mediaKit:slug}/request', [Journalists\DownloadController::class, 'request'])->name('download.request');
	Route::post('/download/{mediaKit:slug}/bulk', [Journalists\DownloadController::class, 'bulk'])->name('download.bulk');

	Route::name('call.')->prefix('invite-story')->group(function () {
		Route::get('/', [Journalists\CallController::class, 'index'])->name('index');
		Route::get('/all', [Journalists\CallController::class, 'all'])->name('all');
		Route::get('/create', [Journalists\CallController::class, 'create'])->name('create');
		Route::get('/{call:slug}/view', [Journalists\CallController::class, 'view'])->name('view');
		Route::get('/{call:slug}/edit', [Journalists\CallController::class, 'edit'])->name('edit');
	});

	Route::name('media-kit.')->prefix('media-kit')->group(function () {
		Route::get('/', [Journalists\MediaKitController::class, 'index'])->name('index');
		Route::get('/{mediaKit:slug}', [Journalists\MediaKitController::class, 'view'])->name('view');
		Route::name('press-release.')->prefix('press-release')->group(function () {
			Route::get('/{mediaKit:slug}', [Journalists\MediaKits\PressReleaseController::class, 'view'])->name('view');
		});
		Route::name('article.')->prefix('article')->group(function () {
			Route::get('/{mediaKit:slug}', [Journalists\MediaKits\ArticleController::class, 'view'])->name('view');
		});
		Route::name('project.')->prefix('project')->group(function () {
			Route::get('/{mediaKit:slug}', [Journalists\MediaKits\ProjectController::class, 'view'])->name('view');
		});
		//Route::get('/{mediaKit}', [Journalists\MediaKitController::class, 'view'])->name('view');
	});

	Route::name('brand.')->prefix('brand')->group(function () {
		Route::get('/', [Journalists\BrandController::class, 'index'])->name('index');
		Route::get('/{brand:slug}', [Journalists\BrandController::class, 'view'])->name('view');
		Route::get('/architect/{architect:slug}', [Journalists\BrandController::class, 'architect'])->name('architect');
	});

	Route::name('submission.')->prefix('submission')->group(function () {
		Route::get('/', [Journalists\SubmissionController::class, 'index'])->name('index');
	});

	Route::name('account.')->prefix('account')->group(function () {
		Route::name('profile.')->prefix('profile')->group(function () {
			Route::get('/', [Journalists\Accounts\ProfileController::class, 'index'])->name('index');
			Route::name('journalists.')->prefix('journalists')->group(function () {
				Route::get('/', [Journalists\Accounts\Profile\JournalistController::class, 'index'])->name('index');
				Route::get('/{journalist:slug}', [Journalists\Accounts\Profile\JournalistController::class, 'view'])->name('view');
			});
			Route::name('publications.')->prefix('publications')->group(function () {
				Route::get('/', [Journalists\Accounts\Profile\PublicationController::class, 'index'])->name('index');
				Route::get('/{publication:slug}', [Journalists\Accounts\Profile\PublicationController::class, 'view'])->name('view');
			});

			Route::get('/notifications', [Journalists\Accounts\ProfileController::class, 'notification'])->name('notification');
			Route::name('message.')->prefix('messages')->group(function () {
				Route::get('/', [Journalists\Accounts\Profile\MessageController::class, 'index'])->name('index');
				Route::get('/subjects', [MessageController::class, 'subjects'])->name('subject');
				Route::get('/chats/{id?}', [MessageController::class, 'chats'])->name('chat');
				Route::post('/send', [MessageController::class, 'send'])->name('send');
			});
			Route::get('/invite-colleague', [Journalists\Accounts\ProfileController::class, 'inviteColleague'])->name('invite-colleague');
			Route::name('setting.')->prefix('settings')->group(function () {
				Route::get('/personal-info', [Journalists\Accounts\SettingController::class, 'personalInfo'])->name('personal-info');
				Route::get('/password', [Journalists\Accounts\SettingController::class, 'password'])->name('password');
				Route::get('/your-publications', [Journalists\Accounts\SettingController::class, 'publication'])->name('publication');
				Route::get('/associated-publications', [Journalists\Accounts\SettingController::class, 'associatedPublication'])->name('associated-publication');
			});
		});
	});
});
