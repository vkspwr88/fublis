<?php

use App\Http\Controllers\Users;
use App\Mail\TestMail;
// use App\Services\Architects\StatsService;
use App\Services\Journalists\StatsService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
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

Route::get('/test', function () {
    $statsService = new StatsService;
	$statsService->sendStatEmails('week');
	var_dump('weekly sent');
	$statsService->sendStatEmails('month');
	var_dump('monthly sent');
})->name('test');

Route::get('/test-email', function () {
	Mail::to('amansaini87@rediffmail.com')->send(new TestMail('amansaini87@rediffmail.com'));
})->name('test-email');

Route::get('/', function () {
	if(isArchitect()){
		return to_route('architect.add-story.index');
	}
	if(isJournalist()){
		return to_route('journalist.media-kit.index');
	}
    return view('users.pages.home');
})->name('home');

Route::get('/privacy-policy', function () {
    return view('users.pages.privacy-policy');
})->name('privacy-policy');

Route::get('/blank', function () {
    return view('users.pages.blank');
})->name('blank');

Route::get('/clear-cache', function(){
    Artisan::call('route:clear');
    Artisan::call('route:cache');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('view:cache');
    return 'All cache cleared';
	// php artisan route:clear
	// php artisan route:cache
	// php artisan config:clear
	// php artisan config:cache
	// php artisan cache:clear
	// php artisan view:clear
	// php artisan view:cache
});

/* Route::get('/email', function () {
    return (new VerifySubscriber())->render();
})->name('email'); */

Route::name('auth.')->prefix('auth')->group(function () {
	Route::name('google.')->prefix('google')->controller(Users\Auth\GoogleController::class)->group(function () {
		Route::get('/user/{userType?}/{loginType?}', 'index')->name('index');
		Route::get('/callback', 'callback')->name('callback');
	});
});

Route::get('/pricing', [Users\SubscriptionPlanController::class, 'index'])->name('pricing');

Route::name('blogs.')->prefix('blogs')->controller(Users\BlogController::class)->group(function () {
	Route::get('/', 'index')->name('index');
	Route::get('/{slug}', 'show')->name('show');
});
// Route::get('/blogs', [Users\BlogController::class, 'index'])->name('blogs.index');
Route::get('/newsletter/subscribe/{token}', [Users\SubscribeNewsletterController::class, 'verify'])->name('subscribe.newsletter.verify');

// Route::get('/blogs/{slug}', [Users\BlogController::class, 'show'])->name('blogs.show');

Route::get('/invitation/{invitation}/{type}', [Users\InvitationController::class, 'index'])->name('invitation');

Route::get('/publications/{categorySlug}/{countrySlug}', [Users\TopPublicationController::class, 'top'])->name('top-publications');
Route::get('/journalists/{categorySlug}/{countrySlug}', [Users\TopJournalistController::class, 'top'])->name('top-journalists');
