<?php

namespace App\Http\Controllers\Affiliates;

use App\Enums\Affiliates\ApplicationStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\AffRegistration;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
	{
		$user = auth()->user();
		$affRegistration = $user->affRegistration;
		if($affRegistration){
			return to_route('affiliate.dashboard');
		}
		return view('users.pages.affiliates.register');
	}

	public function status(AffRegistration $affRegistration)
	{
		if($affRegistration->application_status === ApplicationStatusEnum::APPROVED){
			return to_route('affiliate.dashboard');
		}
		return view('users.pages.affiliates.register-status', [
			'status' => $affRegistration->application_status,
		]);
	}
}
