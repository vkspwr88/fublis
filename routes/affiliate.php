<?php

use App\Http\Controllers\Affiliates;
use App\Http\Middleware\JournalistLogin;
use App\Http\Middleware\RegisterredForAffiliate;
use Illuminate\Support\Facades\Route;

Route::middleware(JournalistLogin::class)->group(function() {
	Route::get('/', function(){
		return to_route('affiliate.register.index');
	})->name('index');
	Route::prefix('/register')
		->name('register.')
		->controller(Affiliates\RegisterController::class)
		->group(function(){
			Route::get('', 'index')->name('index');
			Route::get('/{affRegistration}', 'status')->name('status');
		});

	Route::middleware(RegisterredForAffiliate::class)->group(function() {
		Route::get('/dashboard', [Affiliates\DashboardController::class, 'index'])->name('dashboard');
		Route::get('/urls', [Affiliates\UrlController::class, 'index'])->name('urls');
		Route::get('/stats', [Affiliates\StatsController::class, 'index'])->name('stats');
		Route::get('/graphs', [Affiliates\GraphsController::class, 'index'])->name('graphs');
		Route::get('/referrals', [Affiliates\ReferralsController::class, 'index'])->name('referrals');
		Route::get('/payouts', [Affiliates\PayoutsController::class, 'index'])->name('payouts');
		Route::get('/visits', [Affiliates\VisitsController::class, 'index'])->name('visits');
	});
});
