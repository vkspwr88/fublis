<?php

namespace App\Http\Controllers\Users\Architects\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\CompanyController;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function personalInfo()
	{
		return view('users.pages.architects.accounts.settings.personal-info');
	}

	public function company()
	{
		if(isArchitectAdmin()){
			return view('users.pages.architects.accounts.settings.company');
		}
		return abort(401);
	}

	public function password()
	{
		return view('users.pages.architects.accounts.settings.password');
	}

	public function team()
	{
		if(isArchitectAdmin()){
			return view('users.pages.architects.accounts.settings.team');
		}
		return abort(401);
	}

	public function billing(Request $request)
	{
		if(isArchitectAdmin()){
			$user = $request->user();
			// dd($user->latestSubscription->subscriptionPrice);
			// dd($user->invoices());
			// return $request->user()->redirectToBillingPortal();
			return view('users.pages.architects.accounts.settings.billing'/* , [
				'invoices' => $user->invoices(),
				'paymentMethod' => $user->defaultPaymentMethod(),
				'userCount' => CompanyController::getMediaContacts()->count(),
				'latestSubscription' => $user?->latestSubscription,
				// 'subscriptionPrice' => $user?->latestSubscription?->subscriptionPrice,
			] */);
		}
		return abort(401);
	}

	public function showPaymentMethod(Request $request)
	{
		if(isArchitectAdmin()){
			$user = $request->user();
			$intent = $user->createSetupIntent();
			return view('users.pages.architects.accounts.settings.update-payment', [
				'clientSecret' => $intent->client_secret,
			]);
		}
		return abort(401);
	}

	public function updatePaymentMethod(Request $request)
	{
		$user = $request->user();
		$user->updateDefaultPaymentMethod($request->token);
		return to_route('architect.account.profile.setting.billing')->with([
			'type' => 'success',
			'message' => 'Payment method details has been saved successfully.',
		]);
	}
}
