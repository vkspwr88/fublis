<?php

namespace App\Interfaces;

use App\Models\Guest;

interface GuestRepositoryInterface
{
	public function generateEmailOtp(): string;
	public function createGuest(array $details): Guest;
	public function getGuestById(string $id): Guest;
	public function updateGuestEmailOtpById(string $id, string $otp): Guest;
	public function verifyGuestEmailByOtp(string $id, string $otp);
}
