<?php

namespace App\Services;

use App\Enums\Users\Architects\UserRoleEnum;
use App\Enums\Users\UserTypeEnum;
use App\Http\Controllers\ErrorLogController;
use App\Http\Controllers\Users\ArchitectController;
use App\Http\Controllers\Users\AvatarController;
use App\Http\Controllers\Users\CompanyController;
use App\Http\Controllers\Users\FileController;
use App\Http\Controllers\Users\ImageController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\UserController;
use App\Interfaces\GuestRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Mail\Admin\ArchitectSignUp;
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
			$userRole = UserRoleEnum::SUPERADMIN;
			if($details['new']){
				// insert location record
				$location = LocationController::createLocation([
					'name' => $details['selectedCountry'],
					'country_flag' => 1,
					'state_flag' => 0,
					'city_flag' => 0,
				]);

				$company = CompanyController::createCompany([
					'name' => $details['companyName'],
					'website' => $details['website'],
					'location_id' => $location->id,
					// 'category_id' => $details['selectedCategory'],
					'team_size_id' => $details['selectedTeamSize'],
					'background_color' => AvatarController::getBackground('studio'),
					'foreground_color' => '#ffffff',
				]);
				$companyId = $company->id;
				$company->categories()->attach($details['selectedCategory']);
			}
			else{
				$companyId = $details['selectedCompany'];
				$userRole = UserRoleEnum::ADMIN;
			}
			// insert architect record
			$architect = ArchitectController::createArchitect([
				'slug' => UserController::generateSlug($user->name),
				'user_id' => $user->id,
				'company_id' => $companyId,
				'architect_position_id' => $details['selectedPosition'],
				'background_color' => AvatarController::getBackground('architect'),
				'foreground_color' => '#ffffff',
				'user_role' => $userRole,
			]);
			/* // set profile picture
			$profileImg = 'images/architects/profile' /* create('John Doe')->save('path/to/file.png', $quality = 90) *;
			ImageController::updateOrCreate($architect->profileImage(), [
				'image_type' => 'profile',
				'image_path' => FileController::upload($details['profileImage'], 'images/architects/profile', 'architect_profile'),
			]); */
			if(checkInvitation('architect')){
				$invitation = session()->get('invitation');
				$invitation->is_accepted = true;
				$invitation->save();

				$invitedUser = $this->userRepository->getInvitedArchitectUserById($invitation->invited_by);
				if($invitedUser->architect->company_id == $companyId){
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
			// Send mail to the admin
			Mail::to(env('COMPANY_EMAIL'))
					->cc('amansaini87@rediffmail.com')
					->queue(new ArchitectSignUp($architect));
			// login user
			Auth::login($user);
			session()->forget('guest_id');
		}
		catch(Exception $exp){
            DB::rollBack();
			ErrorLogController::logError(
				'addCompany', [
					'line' => $exp->getLine(),
					'file' => $exp->getFile(),
					'message' => $exp->getMessage(),
					'code' => $exp->getCode(),
				]
			);
			return false;
		}
		return true;
	}

	public function checkCompanyArchitectsLimit($companyId)
	{
		$company = CompanyController::getTotalArchitects($companyId);
		$totalArchitects = $company->architects_count ?? 0;
		$allowedArchitects = CompanyController::getAllowedArchitects('');
		if($totalArchitects > 0){
			$user = $company->architects->where('user_role', UserRoleEnum::SUPERADMIN)->first()->user;
			if (isBusinessPlanSubscribed($user)) {
				$allowedArchitects = CompanyController::getAllowedArchitects('Business Plan');
			}
			elseif (isEnterprisePlanSubscribed($user)) {
				$allowedArchitects = CompanyController::getAllowedArchitects('Enterprise Plan');
			}
			if($totalArchitects >= $allowedArchitects){
				return true;
			}
		}
		return false;
	}
}
