<?php

namespace App\Services;

use App\Interfaces\GuestRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Mail\User\Architect\Signup\VerificationMail;
use Illuminate\Support\Facades\Mail;

class ArchitectService
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

	public function registerGuest(array $details)
	{
		// check user table
		$user = $this->userRepository->isEmailExist($details['email']);
		if($user){
			return false;
		}
		// insert guest record
		$guest = $this->guestRepository->createGuest($details);
		// add guest id in session
		session()->put('guest_id', $guest->id);
		// send verification email
		$this->sendVerificationEmail($guest);
		return true;
	}

	public function sendVerificationEmail($guest)
	{
		Mail::to($guest->email)->send(new VerificationMail($guest));
	}

	public function resendVerificationEmail()
	{
		$guestId = session()->get('guest_id');
		$guest = $this->guestRepository->getGuestById($guestId);
		$this->sendVerificationEmail($guest);
	}

	public function verifyGuestEmail($otp)
	{
		// retrieve guest record
		// verify otp
		// if yes, update email_verified_at
	}

	public function addCompany(array $details)
	{
		// retrieve guest record
		// insert user record
		// insert company record
		// insert architect record
		// send welcome email in queue
		// login user
	}
}
