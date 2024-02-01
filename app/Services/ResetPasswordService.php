<?php

namespace App\Services;

use App\Enums\Users\UserTypeEnum;
use App\Http\Controllers\Users\SettingController;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordService
{
	private UserRepositoryInterface $userRepository;

	public function __construct(
		UserRepositoryInterface $userRepository,
	)
	{
		$this->userRepository = $userRepository;
	}

	public function sendResetPassword(array $details)
	{
		// check user table
		$user = $this->userRepository->isUserExist($details);
		if(!$user){
			return response()->json([
				'success' => false,
				'message' => 'Email address is not in our record.',
			]);
		}
		if($user->google_id){
			return response()->json([
				'success' => false,
				'message' => 'Try login through google.',
			]);
		}
		/* if($user->user_type != $details['user_type']){
			return response()->json([
				'success' => false,
				'message' => 'Invalid user.',
			]);
		} */
		$status = Password::sendResetLink(
			Arr::only($details, ['email'])
		);

		if($status === Password::RESET_LINK_SENT){
			return response()->json([
				'success' => true,
				'message' => __($status),
			]);
		}

		return response()->json([
			'success' => false,
			'message' => __($status),
		]);
	}

	public function getEmailFromToken(string $token)
	{
		return DB::table('password_reset_tokens')
					->where([
						'token' => Hash::make($token),
						['created_at', '>=', Carbon::now()->subMinutes(SettingController::getValue('RESET_PASSWORD_TIMEOUT'))]
					])
					->dd();
	}

	public function resetPassword(array $details)
	{
		$status = Password::reset(
			Arr::only($details, ['email', 'password', 'password_confirmation', 'token']),
			function (User $user, string $password) {
				$user->forceFill([
					'password' => $password
				])->setRememberToken(Str::random(60));
	 
				$user->save();
			}
		);

		if($status === Password::PASSWORD_RESET){
			$user = $this->userRepository->isEmailExist($details['email']);
			if($user->user_type === UserTypeEnum::ARCHITECT){
				$redirectUrl = route('architect.login');
			}
			elseif($user->user_type === UserTypeEnum::JOURNALIST){
				$redirectUrl = route('journalist.login');
			}
			return response()->json([
				'success' => true,
				'message' => __($status),
				'redirect_url' => $redirectUrl,
			]);
		}

		return response()->json([
			'success' => false,
			'message' => __($status),
		]);
	}
}
