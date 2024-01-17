<?php

namespace App\Http\Controllers\Users\Auth;

use App\Enums\Users\UserTypeEnum;
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

	public function index(UserTypeEnum $userType)
	{
		//dd($userType);
		session()->put('user_type', $userType);
		return Socialite::driver('google')
						//->with(['user_type' => $userType])
						->redirect();
	}

    public function callback(Request $request)
	{
		// http://127.0.0.1:8000/auth/google/callback?state=NmyZ2ox54TfM85NLv5EZX8vmg6vp4bqRQiR7KT24&code=4%2F0AfJohXltmFYbKZMK1zSSVovyC2qfGF9kk9GI1n8GfoFaSyT1UlVvO-aMPm0-0Uk3_aZkDQ&scope=email+profile+openid+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email&authuser=0&prompt=consent
		try{
			DB::beginTransaction();
			// $googleUser = Socialite::driver('google');
			$googleUser = Socialite::driver('google')->user();
			// dd($googleUser, $request);
			$response = $this->googleService->checkGoogleUser($googleUser);
			dd($response);
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
