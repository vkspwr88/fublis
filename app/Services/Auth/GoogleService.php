<?php

namespace App\Services\Auth;

use App\Enums\Users\UserTypeEnum;
use App\Interfaces\GuestRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class GoogleService
{
	private GuestRepositoryInterface $guestRepository;
	private UserRepositoryInterface $userRepository;

	public function __construct(
		GuestRepositoryInterface $guestRepository,
		UserRepositoryInterface $userRepository,
	)
	{
		$this->guestRepository = $guestRepository;
		$this->userRepository = $userRepository;
	}

	public function checkGoogleUser($googleUser)
	{
		// check email exists
		$user = $this->userRepository->isEmailExist($googleUser->email);
		$userType = session()->get('user_type');
		if($user){
			if($user->google_id === $googleUser->id){
				// login user according to user type
				Auth::login($user);
				/* $redirectUrl = route('architect.signup', ['step' => 'architect-signup-success-step']);
				if($userType === UserTypeEnum::JOURNALIST){
					$redirectUrl = route('journalist.signup', ['step' => 'journalist-signup-success-step']);
				} */
				$redirectUrl = route('home');

				return response()->json([
					'success' => true,
					'message' => 'You have successfully log in with the google account.',
					'redirect_url' => $redirectUrl,
				]);
			}
			else{
				return response()->json([
					'success' => false,
					'message' => 'Try login through email and password.',
				]);
			}
		}
		else{
			// reguster and verify guest
			$password = uniqid();
			$guest = $this->guestRepository->registerAndVerifyGuest([
				'name' => $googleUser->name,
				'email' => $googleUser->email,
				'password' => $password,
				'email_verified_at' => Carbon::now(),
				'user_type' => $userType,
				'google_id' => $googleUser->id,
				'ip_address' => request()->ip(),
			]);
			session()->put('guest_id', $guest->id);
			// redirect to after verify otp step
			if($userType === UserTypeEnum::JOURNALIST){
				session()->put('initial_state', [
					'journalist-signup-step' => [
						'email' => $googleUser->email,
						'password' => $password,
					],
				]);
				$redirectUrl = route('journalist.signup', ['step' => 'journalist-signup-add-publication-step']);
			}
			elseif($userType === UserTypeEnum::ARCHITECT){
				session()->put('initial_state', [
					'architect-signup-step' => [
						'email' => $googleUser->email,
						'password' => $password,
					],
				]);
				$redirectUrl = route('architect.signup', ['step' => 'architect-signup-add-company-step']);
			}

			return response()->json([
				'success' => true,
				'message' => 'You have successfully created the google account.',
				'redirect_url' => $redirectUrl,
			]);
		}
	}
}
