<?php

use App\Http\Controllers\Users\Architects;
use App\Http\Middleware\ArchitectLogin;
use App\Models\Architect;
use Illuminate\Support\Facades\Route;

Route::get('/signup', [Architects\Auth\SignupController::class, 'index'])->name('signup');
Route::get('/login', [Architects\Auth\LoginController::class, 'index'])->name('login');
Route::get('/logout', [Architects\Auth\LogoutController::class, 'index'])->name('logout');

Route::middleware(ArchitectLogin::class)->group(function() {
	Route::name('add-story.')->prefix('add-story')->group(function () {
		Route::get('/', [Architects\AddStoryController::class, 'index'])->name('index');
		Route::get('/press-release', [Architects\AddStories\PressReleaseController::class, 'index'])->name('press-release');
		Route::get('/press-release/success', [Architects\AddStoryController::class, 'success'])->name('press-release.success');
		Route::get('/article', [Architects\AddStories\ArticleController::class, 'index'])->name('article');
		Route::get('/article/success', [Architects\AddStoryController::class, 'success'])->name('article.success');
		Route::get('/project', [Architects\AddStories\ProjectController::class, 'index'])->name('project');
		Route::get('/project/success', [Architects\AddStoryController::class, 'success'])->name('project.success');
	});

	Route::name('media-kit.')->prefix('media-kit')->group(function () {
		Route::get('/', [Architects\MediaKitController::class, 'index'])->name('index');
		Route::get('/{media_kit}', [Architects\MediaKitController::class, 'view'])->name('view');
		Route::name('press-release.')->prefix('press-release')->group(function () {
			Route::get('/{mediaKit}', [Architects\MediaKits\PressReleaseController::class, 'view'])->name('view');
			Route::get('/{mediaKit}/edit', [Architects\MediaKits\PressReleaseController::class, 'edit'])->name('edit');
		});
		Route::name('article.')->prefix('article')->group(function () {
			Route::get('/{mediaKit}', [Architects\MediaKits\ArticleController::class, 'view'])->name('view');
			Route::get('/{mediaKit}/edit', [Architects\MediaKits\ArticleController::class, 'edit'])->name('edit');
		});
		Route::name('project.')->prefix('project')->group(function () {
			Route::get('/{mediaKit}', [Architects\MediaKits\ProjectController::class, 'view'])->name('view');
			Route::get('/{mediaKit}/edit', [Architects\MediaKits\ProjectController::class, 'edit'])->name('edit');
		});
	});

	Route::name('pitch-story.')->prefix('pitch-story')->group(function () {
		Route::get('/', [Architects\PitchStories\PublicationController::class, 'index'])->name('index');
		Route::name('publications.')->prefix('publications')->group(function () {
			Route::get('/', [Architects\PitchStories\PublicationController::class, 'index'])->name('index');
			Route::get('/{publication}', [Architects\PitchStories\PublicationController::class, 'view'])->name('view');
		});
		Route::name('journalists.')->prefix('journalists')->group(function () {
			Route::get('/', [Architects\PitchStories\JournalistController::class, 'index'])->name('index');
			Route::get('/{journalist}', [Architects\PitchStories\JournalistController::class, 'view'])->name('view');
		});
		Route::name('calls.')->prefix('calls')->group(function () {
			Route::get('/', [Architects\PitchStories\CallController::class, 'index'])->name('index');
			Route::get('/{call}', [Architects\PitchStories\CallController::class, 'view'])->name('view');
		});
	});

	Route::name('account.')->prefix('account')->group(function () {
		Route::name('studio.')->prefix('studio')->group(function () {
			Route::get('/', [Architects\Accounts\StudioController::class, 'index'])->name('index');
			Route::get('/other', [Architects\Accounts\StudioController::class, 'other'])->name('other');
		});
		Route::name('profile.')->prefix('profile')->group(function () {
			Route::get('/', [Architects\Accounts\ProfileController::class, 'index'])->name('index');
			Route::get('/analytics', [Architects\Accounts\ProfileController::class, 'analytic'])->name('analytic');
			Route::get('/alerts', [Architects\Accounts\ProfileController::class, 'alert'])->name('alert');
			Route::get('/notifications', [Architects\Accounts\ProfileController::class, 'notification'])->name('notification');
			Route::get('/messages', [Architects\Accounts\ProfileController::class, 'message'])->name('message');
			Route::get('/invite-colleague', [Architects\Accounts\ProfileController::class, 'inviteColleague'])->name('invite-colleague');
			Route::name('setting.')->prefix('settings')->group(function () {
				Route::get('/personal-info', [Architects\Accounts\SettingController::class, 'personalInfo'])->name('personal-info');
				Route::get('/company', [Architects\Accounts\SettingController::class, 'company'])->name('company');
				Route::get('/password', [Architects\Accounts\SettingController::class, 'password'])->name('password');
				Route::get('/team', [Architects\Accounts\SettingController::class, 'team'])->name('team');
				Route::get('/billing', [Architects\Accounts\SettingController::class, 'billing'])->name('billing');
			});
		});
	});

	Route::get('/journalist/{journalist_id}', [Architects\AddStoryController::class, 'index'])->name('journalist');
	Route::get('/publication/{publication_id}', [Architects\AddStoryController::class, 'index'])->name('publication');
});
