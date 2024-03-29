<?php

namespace App\Http\Controllers\Users\Architects\Accounts;

use App\Http\Controllers\Controller;
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
			// dd($user->invoices());
			// return $request->user()->redirectToBillingPortal();
			return view('users.pages.architects.accounts.settings.billing', [
				'invoices' => $user->invoices(),
				'paymentMethod' => $user->defaultPaymentMethod(),
			]);
		}
		return abort(401);
	}
}
