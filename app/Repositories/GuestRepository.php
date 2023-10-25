<?php

namespace App\Repositories;

use App\Http\Controllers\SettingController;
use App\Interfaces\GuestRepositoryInterface;
use App\Models\Guest;
use Carbon\Carbon;

class GuestRepository implements GuestRepositoryInterface
{
	public function generateEmailOtp(): string
	{
		return (string)rand(1000, 9999);
	}

	public function createGuest(array $details): Guest
	{
		$details['email_otp'] = $this->generateEmailOtp();
		return Guest::create($details);
	}

	public function getGuestById(string $id): Guest
	{
		return Guest::find($id);
	}

	public function updateGuestEmailOtpById(string $id, string $otp): Guest
	{
		$guest = $this->getGuestById($id);
		if($guest){
			$guest->email_otp = $otp;
			$guest->save();
		}
		return $guest;
	}

	public function verifyGuestEmailByOtp(string $id, string $otp)
	{
		return Guest::where([
						'id' => $id,
						'email_otp' => $otp,
						['updated_at', '>=', Carbon::now()->subMinutes(SettingController::getValue('EMAIL_VERIFICATION_TIMEOUT'))]
					])->update([
						'email_verified_at' => Carbon::now(),
					]);
	}
}
