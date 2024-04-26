<?php

use App\Http\Controllers\Payments\StripeController;
use App\Http\Controllers\Users\Architects;
use App\Http\Controllers\Users\MessageController;
use App\Http\Controllers\Users\TrixFileUploadController;
use App\Http\Middleware\ArchitectLogin;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->middleware('guest')->group(function () {
	Route::get('/signup/{step?}', [Architects\Auth\SignupController::class, 'index'])->name('signup');
	Route::get('/login', [Architects\Auth\LoginController::class, 'index'])->name('login');
	Route::get('/logout', [Architects\Auth\LogoutController::class, 'index'])->name('logout')->withoutMiddleware('guest');
	Route::get('/forgot-password', [Architects\Auth\ForgotPasswordController::class, 'index'])->name('forgot');
	Route::get('/reset-password/{token}/{email}', [Architects\Auth\ResetPasswordController::class, 'index'])->name('reset');
});

Route::middleware(ArchitectLogin::class)->group(function() {
	Route::name('media-kit.')->prefix('media-kit')->group(function () {
		Route::get('/', [Architects\MediaKitController::class, 'index'])->name('index');
		Route::get('/{mediaKit:slug}', [Architects\MediaKitController::class, 'view'])->name('view');
		Route::get('/{mediaKit:slug}/edit', [Architects\MediaKitController::class, 'edit'])->name('edit');
		Route::name('press-release.')->prefix('press-release')->group(function () {
			Route::get('/{mediaKit:slug}', [Architects\MediaKits\PressReleaseController::class, 'view'])->name('view');
			Route::get('/{mediaKit:slug}/edit', [Architects\MediaKits\PressReleaseController::class, 'edit'])->name('edit');
		});
		Route::name('article.')->prefix('article')->group(function () {
			Route::get('/{mediaKit:slug}', [Architects\MediaKits\ArticleController::class, 'view'])->name('view');
			Route::get('/{mediaKit:slug}/edit', [Architects\MediaKits\ArticleController::class, 'edit'])->name('edit');
		});
		Route::name('project.')->prefix('project')->group(function () {
			Route::get('/{mediaKit:slug}', [Architects\MediaKits\ProjectController::class, 'view'])->name('view');
			Route::get('/{mediaKit:slug}/edit', [Architects\MediaKits\ProjectController::class, 'edit'])->name('edit');
		});
	});

	Route::prefix('user')->group(function () {
		/* Route::get('/payment', function(){
			echo 'checking payment';
		})->name('test'); */
		Route::post('/trix-file-upload', [TrixFileUploadController::class, 'upload'])->name('trix-file-upload');
		Route::post('/trix-file-remove', [TrixFileUploadController::class, 'remove'])->name('trix-file-remove');
		Route::get('/pricing', [StripeController::class, 'index'])->name('stripe.index');
		Route::get('/checkout/{subscriptionPlan:slug}', [StripeController::class, 'checkout'])->name('stripe.checkout');
		Route::post('/checkout/{subscriptionPlan:slug}/callback', [StripeController::class, 'callback'])->name('stripe.callback');
		Route::get('/invoice/{invoice}', [StripeController::class, 'downloadInvoice'])->name('stripe.invoice.download');

		Route::post('/download/{mediaKit:slug}', [Architects\DownloadController::class, 'index'])->name('download');
		Route::post('/download/{mediaKit:slug}/bulk', [Architects\DownloadController::class, 'bulk'])->name('download.bulk');

		Route::name('add-story.')->prefix('add-story')->group(function () {
			Route::get('/', [Architects\AddStoryController::class, 'index'])->name('index');
			Route::name('draft.')->prefix('draft')->group(function () {
				Route::get('/', [Architects\MediaKitDraftController::class, 'index'])->name('index');
				Route::get('/{mediaKitDraft}', [Architects\MediaKitDraftController::class, 'view'])->name('view');
			});
			Route::name('press-release.')->prefix('press-release')->group(function () {
				Route::get('/', [Architects\AddStories\PressReleaseController::class, 'index'])->name('index');
				Route::get('/draft/{mediaKitDraft}', [Architects\AddStories\PressReleaseController::class, 'draft'])->name('draft');
				Route::get('/preview/{mediaKitDraft}', [Architects\AddStories\PressReleaseController::class, 'preview'])->name('preview');
				Route::get('/success', [Architects\AddStoryController::class, 'success'])->name('success');
			});
			Route::name('article.')->prefix('article')->group(function () {
				Route::get('/', [Architects\AddStories\ArticleController::class, 'index'])->name('index');
				Route::get('/draft/{mediaKitDraft}', [Architects\AddStories\ArticleController::class, 'draft'])->name('draft');
				Route::get('/preview/{mediaKitDraft}', [Architects\AddStories\ArticleController::class, 'preview'])->name('preview');
				Route::get('/success', [Architects\AddStoryController::class, 'success'])->name('success');
			});
			Route::name('project.')->prefix('project')->group(function () {
				Route::get('/', [Architects\AddStories\ProjectController::class, 'index'])->name('index');
				Route::get('/draft/{mediaKitDraft}', [Architects\AddStories\ProjectController::class, 'draft'])->name('draft');
				Route::get('/preview/{mediaKitDraft}', [Architects\AddStories\ProjectController::class, 'preview'])->name('preview');
				Route::get('/success', [Architects\AddStoryController::class, 'success'])->name('success');
			});
		});

		Route::name('pitch-story.')->prefix('pitch-story')->group(function () {
			Route::get('/', [Architects\PitchStories\PublicationController::class, 'index'])->name('index');
			Route::name('publications.')->prefix('publications')->group(function () {
				Route::get('/', [Architects\PitchStories\PublicationController::class, 'index'])->name('index');
				Route::get('/{publication:slug}', [Architects\PitchStories\PublicationController::class, 'view'])->name('view');
			});
			Route::name('journalists.')->prefix('journalists')->group(function () {
				Route::get('/', [Architects\PitchStories\JournalistController::class, 'index'])->name('index');
				Route::get('/{journalist:slug}', [Architects\PitchStories\JournalistController::class, 'view'])->name('view');
			});
			Route::name('calls.')->prefix('calls')->group(function () {
				Route::get('/', [Architects\PitchStories\CallController::class, 'index'])->name('index');
				Route::get('/{call:slug}', [Architects\PitchStories\CallController::class, 'view'])->name('view');
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
				Route::name('message.')->prefix('messages')->group(function () {
					Route::get('/', [Architects\Accounts\Profile\MessageController::class, 'index'])->name('index');
					Route::get('/subjects', [MessageController::class, 'subjects'])->name('subject');
					Route::get('/chats/{id?}', [MessageController::class, 'chats'])->name('chat');
					Route::post('/send', [MessageController::class, 'send'])->name('send');
				});
				Route::get('/invite-colleague', [Architects\Accounts\ProfileController::class, 'inviteColleague'])->name('invite-colleague');
				Route::name('setting.')->prefix('settings')->group(function () {
					Route::get('/personal-info', [Architects\Accounts\SettingController::class, 'personalInfo'])->name('personal-info');
					Route::get('/company', [Architects\Accounts\SettingController::class, 'company'])->name('company');
					Route::get('/password', [Architects\Accounts\SettingController::class, 'password'])->name('password');
					Route::get('/team', [Architects\Accounts\SettingController::class, 'team'])->name('team');
					Route::get('/billing', [Architects\Accounts\SettingController::class, 'billing'])->name('billing');
					Route::get('/billing/payment-method', [Architects\Accounts\SettingController::class, 'showPaymentMethod'])->name('billing.payment-method.show');
					Route::post('/billing/payment-method', [Architects\Accounts\SettingController::class, 'updatePaymentMethod'])->name('billing.payment-method.update');
				});
			});
		});

		/* Route::get('/journalist/{journalist_id:slug}', [Architects\AddStoryController::class, 'index'])->name('journalist');
		Route::get('/publication/{publication_id:slug}', [Architects\AddStoryController::class, 'index'])->name('publication'); */
	});
});
