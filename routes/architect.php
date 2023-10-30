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

		/* Route::get('/article/{id}', function(){
			return view('users.pages.architects.media-kit.article.view');
		})->name('article.view');
		Route::get('/article/{id}/edit', function(){
			return view('users.pages.architects.media-kit.article.edit');
		})->name('article.edit');
		Route::get('/project/{id}', function(){
			return view('users.pages.architects.media-kit.project.view');
		})->name('project.view');
		Route::get('/project/{id}/edit', function(){
			return view('users.pages.architects.media-kit.project.edit');
		})->name('project.edit'); */
	});

	Route::name('pitch-story.')->prefix('pitch-story')->group(function () {
		Route::get('/', function(){
			return view('users.pages.architects.pitch-story.publication.index', [
				'categories' => array(),
				'publicationTypes' => array(),
			]);
		})->name('index');
		Route::name('publications.')->prefix('publications')->group(function () {
			Route::get('/', function(){
				return view('users.pages.architects.pitch-story.publication.index', [
					'categories' => array(),
					'publicationTypes' => array(),
				]);
			})->name('index');
			Route::get('/{id}', function(){
				return view('users.pages.architects.pitch-story.publication.view');
			})->name('view');
		});
		Route::name('journalists.')->prefix('journalists')->group(function () {
			Route::get('/', function(){
				return view('users.pages.architects.pitch-story.journalist.index', [
					'categories' => array(),
					'publicationTypes' => array(),
					'roleTypes' => array(),
				]);
			})->name('index');
		});
		Route::name('calls.')->prefix('calls')->group(function () {
			Route::get('/', function(){
				return view('users.pages.architects.pitch-story.call.index', [
					'categories' => array(),
					'publicationTypes' => array(),
				]);
			})->name('index');
		});
	});
});
