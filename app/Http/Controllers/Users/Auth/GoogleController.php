<?php

namespace App\Http\Controllers\Users\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\GoogleService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
	private GoogleService $googleService;

	public function __construct(
		GoogleService $googleService,
	)
	{
		$this->googleService = $googleService;
	}

	public function index(string $userType)
	{
		return Socialite::driver('google')
						->with(['userType' => $userType])
						->redirect();
	}

    public function callback()
	{
		//return to_route('architect.signup', ['step' => 'architect-signup-add-company-step']);
		try{
			DB::beginTransaction();
			$googleUser = Socialite::driver('google')->user();
			dd($googleUser);
			$response = $this->googleService->checkGoogleUser($googleUser);
			$response = json_decode($response);
			if($response->success){
				DB::commit();
				return to_route($response->redirect_url);
			}
			throw $response->message;
		}
		catch(Exception $exp){
			DB::rollBack();
			dd($exp->getMessage());
		}
	}
}
