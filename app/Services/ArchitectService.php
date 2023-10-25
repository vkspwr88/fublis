<?php

namespace App\Services;

use App\Enums\Users\UserTypeEnum;
use App\Http\Controllers\Users\CompanyController;
use App\Interfaces\GuestRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Mail\User\Architect\Signup\VerificationMail;
use App\Mail\User\Architect\Signup\WelcomeMail;
use App\Models\Architect;
use Illuminate\Support\Facades\Auth;
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
		$otp = $this->guestRepository->generateEmailOtp();
		$guest = $this->guestRepository->updateGuestEmailOtpById($guestId, $otp);
		if($guest){
			$this->sendVerificationEmail($guest);
			return true;
		}
		return false;
	}

	public function verifyGuestEmail(string $otp)
	{
		// retrieve guest record
		$guestId = session()->get('guest_id');
		// verify otp, if yes, update email_verified_at
		return $this->guestRepository->verifyGuestEmailByOtp($guestId, $otp);
	}

	public function addCompany(array $details)
	{
		// retrieve guest record
		$guestId = session()->get('guest_id');
		$guest = $this->guestRepository->getGuestById($guestId);
		// insert user record
		$user = $this->userRepository->createUser([
			'name' => $guest->name,
			'email' => $guest->email,
			'password' => $guest->password,
			'user_type' => UserTypeEnum::ARCHITECT,
			'email_verified_at' => $guest->email_verified_at,
		]);
		// insert company record
		$company = CompanyController::createCompany([
			'name' => $details['companyName'],
			'website' => $details['website'],
			'location_id' => $details['location'],
			'category_id' => $details['category'],
			'team_size_id' => $details['teamSize'],
		]);
		// insert architect record
		$architect = Architect::create([
			'user_id' => $user->id,
			'company_id' => $company->id,
			'architect_position_id' => $details['position'],
		]);
		// send welcome email in queue
		Mail::to($guest->email)->queue(new WelcomeMail($guest->email));
		// login user
		Auth::login($user);
		session()->forget('guest_id');
	}
}
