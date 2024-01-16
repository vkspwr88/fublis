<?php

namespace App\Interfaces;

interface GuestRepositoryInterface
{
	public function generateEmailOtp(): string;
	public function createGuest(array $details);
	public function getGuestById(string $id);
	public function updateGuestEmailOtpById(string $id, string $otp);
	public function verifyGuestEmailByOtp(string $id, string $otp);
	public function registerAndVerifyGuest(array $details);
}
