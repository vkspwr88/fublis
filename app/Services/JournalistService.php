<?php

namespace App\Services;

use App\Enums\Users\UserTypeEnum;
use App\Http\Controllers\ErrorLogController;
use App\Http\Controllers\Users\AvatarController;
use App\Http\Controllers\Users\CompanyController;
use App\Http\Controllers\Users\JournalistController;
use App\Http\Controllers\Users\JournalistPositionController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\PublicationController;
use App\Http\Controllers\Users\UserController;
use App\Interfaces\GuestRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Mail\Admin\JournalistSignUp;
use App\Mail\User\Journalist\Signup\VerificationMail;
use App\Mail\User\Journalist\Signup\WelcomeMail;
use App\Models\Architect;
use App\Models\Journalist;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class JournalistService
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
		if(checkInvitation('journalist')){
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

	public function addJournalist(array $details)
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
				'user_type' => UserTypeEnum::JOURNALIST,
				'email_verified_at' => $guest->email_verified_at,
				'google_id' => $guest->google_id,
			]);
			// check publication
			// if new, insert publication record
			if($details['publication']['new']){
				// insert location record
				$location = LocationController::createLocation([
					'name' => $details['publication']['selectedCountry'],
					'country_flag' => 1,
					'state_flag' => 0,
					'city_flag' => 0,
				]);
				$publication = PublicationController::createPublication([
					'name' => $details['publication']['publicationName'],
					'website' => $details['publication']['website'],
					'location_id' => $location->id,
					'background_color' => AvatarController::getBackground('publication'),
					'foreground_color' => '#ffffff',
				]);
				$publication->categories()->attach($details['publication']['categories']);
				$publication->languages()->attach($details['publication']['languages']);
				$publication->publishFrom()->attach($details['publication']['publishFrom']);
				$publication->publicationTypes()->attach($details['publication']['publicationTypes']);
				$publicationId = $publication->id;
			}
			// if old, retrieve publication record
			else{
				$publicationId = $details['publication']['publication_id'];
				$publication = PublicationController::findById($publicationId);
			}

			// if position is other, saved it
			if($details['position'] == 'other'){
				$details['position'] = JournalistPositionController::create([
					'name' => $details['otherPosition'],
				])->id;
			}

			// insert journalist record
			$journalist = JournalistController::createJournalist([
				'slug' => UserController::generateSlug($user->name),
				'user_id' => $user->id,
				'journalist_position_id' => $details['position'],
				'linked_profile' => $details['linkedinProfile'],
				'published_article_link' => $details['publishedArticleLink'],
				'publishing_platform_link' => $details['publishingPlatformLink'],
				'background_color' => AvatarController::getBackground('journalist'),
				'foreground_color' => '#ffffff',
			]);

			$publication->added_by = $journalist->id;
			$publication->save();

			// attach journalist with publication
			$journalist->publications()->attach($publicationId, [
				'journalist_position_id' => $details['position'],
			]);
			// attach journalist with associated publication
			//$journalist->associatedPublications()->attach($publicationId);

			if(checkInvitation('journalist')){
				$invitation = session()->get('invitation');
				$invitation->is_accepted = true;
				$invitation->save();
			}

			DB::commit();
			// send welcome email in queue
			Mail::to($guest->email)->queue(new WelcomeMail($guest->email));
			// Send mail to the admin
			Mail::to(env('COMPANY_EMAIL'))
					->cc('amansaini87@rediffmail.com')
					->queue(new JournalistSignUp($journalist));
			// login user
			Auth::login($user);
			session()->forget('guest_id');
		}
		catch(Exception $exp){
            DB::rollBack();
			ErrorLogController::logError(
				'addJournalist', [
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
}
