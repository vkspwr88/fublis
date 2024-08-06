<?php

namespace App\Services;

use App\Enums\Users\UserTypeEnum;
use App\Http\Controllers\ErrorLogController;
use App\Mail\User\Architect\DailyDownloadRequestMail;
use App\Mail\User\Journalist\DailyMediaKitMail;
use App\Mail\User\Journalist\DailyPitchReceivedMail;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;

class CronService
{
	public static function sendArchitectDailyDownloadRequests()
	{
		info("SendArchitectDailyDownloadRequests Cron Job running at " . now());
		try{
			$pendingDownloadRequests = DownloadRequestService::getTodayPendingRequests();
			$pendingDownloadRequests = DownloadRequestService::loadModel($pendingDownloadRequests);
			// dd($pendingDownloadRequests->groupBy('mediaKit.architect.user'));
			$requestGroup = $pendingDownloadRequests->groupBy('mediaKit.architect.user');
			foreach($requestGroup as $user => $downloadRequest){
				// dd($downloadRequest->pluck('mediaKit')->pluck('story')->pluck('title'), json_decode($user), $downloadRequest);
				$mediaKitTitles = $downloadRequest->pluck('mediaKit.story.title');
				$user = json_decode($user);
				// dd($user->email, $user->name, $mediaKitTitles);
				Mail::to($user->email)->queue(new DailyDownloadRequestMail($user->email, $user->name, $mediaKitTitles));
				// Mail::to('amansaini87@rediffmail.com')->queue(new DailyDownloadRequestMail($user->email, $user->name, $mediaKitTitles));
			}
			/* $statsService = new StatsService;
			$statsService->sendStatEmails('month'); */
		}
		catch(Exception $exp){
			ErrorLogController::logErrorNew('SendArchitectDailyDownloadRequests', $exp);
		}
		info("SendArchitectDailyDownloadRequests Cron Job ended at " . now());
	}

	public static function sendJournalistDailyNewMediaKits()
	{
		info("SendJournalistDailyNewMediaKits Cron Job running at " . now());
		try{
			$users = MediaKitService::getTodayMediaKits();
			// dd($users);
			foreach($users as $user){
				$mediaKits1 = $user->journalist->publications->pluck('categories')->flatten()->pluck('mediaKits')->flatten();
				$mediaKits2 = $user->journalist->associatedPublications->pluck('categories')->flatten()->pluck('mediaKits')->flatten();
				$mediaKits = $mediaKits1->merge($mediaKits2)->pluck('story')->select(['cover_image_path', 'title']);
				// dd($mediaKits, $user, $mediaKits1, $mediaKits2);
				Mail::to($user->email)->queue(new DailyMediaKitMail($user->email, $user->name, $mediaKits));
			}
		}
		catch(Exception $exp){
			ErrorLogController::logErrorNew('SendJournalistDailyNewMediaKits', $exp);
		}
		info("SendJournalistDailyNewMediaKits Cron Job ended at " . now());
	}

	public static function sendJournalistDailyNewPitches()
	{
		info("SendJournalistDailyNewPitches Cron Job running at " . now());
		try{
			$pitches = PitchStoryService::getTodayPitches();
			$requestGroup = $pitches->groupBy('journalist.user');
			// dd($pitches, $requestGroup);
			foreach($requestGroup as $user => $pitch){
				$user = json_decode($user);
				Mail::to($user->email)->queue(new DailyPitchReceivedMail($user->email, $user->name));
			}
		}
		catch(Exception $exp){
			ErrorLogController::logErrorNew('SendJournalistDailyNewPitches', $exp);
		}
		info("SendJournalistDailyNewPitches Cron Job ended at " . now());
	}

}
