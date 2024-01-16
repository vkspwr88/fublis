<?php

namespace App\Services;

use App\Enums\Users\Architects\UserRoleEnum;
use App\Enums\Users\UserTypeEnum;
use App\Http\Controllers\Users\ArchitectController;
use App\Http\Controllers\Users\CompanyController;
use App\Http\Controllers\Users\LocationController;
use App\Interfaces\GuestRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Mail\User\Architect\Signup\VerificationMail;
use App\Mail\User\Architect\Signup\WelcomeMail;
use App\Models\Architect;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
		if(checkInvitation('architect')){
			$guest->email_verified_at = Carbon::now();
			$guest->save();
		}
		else{
			// send verification email
			$this->sendVerificationEmail($guest);
		}
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
		try{
            DB::beginTransaction();
			// retrieve guest record
			$guestId = session()->get('guest_id');
			$guest = $this->guestRepository->getGuestById($guestId);
			// insert user record
			$user = $this->userRepository->createUser([
				'name' => $guest->name,
				'email' => $guest->email,
				'password' => $details['password'],
				'user_type' => UserTypeEnum::ARCHITECT,
				'email_verified_at' => $guest->email_verified_at,
				'google_id' => $guest->google_id,
			]);
			// check publication
			// if new, insert company record
			if($details['new']){
				// insert location record
				$location = LocationController::createLocation([
					'name' => $details['selectedCity'],
				]);

				$company = CompanyController::createCompany([
					'name' => $details['companyName'],
					'website' => $details['website'],
					'location_id' => $location->id,
					'category_id' => $details['selectedCategory'],
					'team_size_id' => $details['selectedTeamSize'],
				]);
				$companyId = $company->id;
			}
			else{
				$companyId = $details['selectedCompany'];
			}
			// insert architect record
			$architect = ArchitectController::createArchitect([
				'slug' => ArchitectController::generateSlug($user->name),
				'user_id' => $user->id,
				'company_id' => $companyId,
				'architect_position_id' => $details['selectedPosition'],
			]);
			if(checkInvitation('architect')){
				$invitation = session()->get('invitation');
				$invitation->is_accepted = true;
				$invitation->save();

				$invitedUser = $this->userRepository->getInvitedArchitectUserById($invitation->invited_by);
				if($invitedUser->architect->company->name == $company->name){
					$architect->user_role = $invitation->user_role ?? UserRoleEnum::ADMIN;
					/* if($invitation->user_role){
						$architect->user_role = $invitation->user_role;
					}
					else{
						$architect->user_role = UserRoleEnum::ADMIN;
					} */
					$architect->save();
				}
			}
			/* else{
				if(!$company->wasRecentlyCreated){
					$architect->user_role = UserRoleEnum::READ_ONLY;
					$architect->save();
				}
			} */
			DB::commit();
			// send welcome email in queue
			Mail::to($guest->email)->queue(new WelcomeMail($guest->email));
			// login user
			Auth::login($user);
			session()->forget('guest_id');
		}
		catch(Exception $exp){
            DB::rollBack();
			dd($exp->getMessage());
			return false;
		}
		return true;
	}
}
