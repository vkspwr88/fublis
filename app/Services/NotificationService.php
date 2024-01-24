<?php

namespace App\Services;

use App\Enums\Users\Architects\UserRoleEnum;
use App\Models\Analytic;
use App\Models\MediaKitDownload;
use App\Models\MediaKitView;
use App\Models\Notification;

class NotificationService
{
	public static function sendViewCountNotification(array $data)
	{
		$analytic = Analytic::where([
								'media_kit_id' => $data['media_kit_id'],
								'journalist_id' => $data['journalist_id'],
								'data_type' => 'App\Models\MediaKitView',
							])->first();

		if(!$analytic){
			$mediaKitView = MediaKitView::create([]);
			$analytic = $mediaKitView->stats()
							->create([
								'media_kit_id' => $data['media_kit_id'],
								'journalist_id' => $data['journalist_id'],
							]);
		}

		$notification = Notification::where([
										'user_id' => $data['architect_user_id'],
										'notifiable_id' => $analytic->id,
									])->first();

		if(!$notification){
			$subject = 'Journalist viewed your media kit';
			$message = '<a href="' . route('architect.pitch-story.journalists.view', ['journalist' => $data['journalist_slug']]) . '" class="text-purple-700">' . $data['journalist_name'] . '</a> viewed your Media Kit <a href="' . route('architect.media-kit.view', ['mediaKit' => $data['media_kit_slug']]) . '" class="text-purple-700">' . $data['media_kit_title'] . '</a>';
			$notification = $analytic->notification()
										->create([
											'user_id' => $data['architect_user_id'],
											'subject' => $subject,
											'message' => $message,
										]);
		}
	}

	public function sendDownloadCountNotification(array $data)
	{
		$analytic = Analytic::where([
								'media_kit_id' => $data['media_kit_id'],
								'journalist_id' => $data['journalist_id'],
								'data_type' => 'App\Models\MediaKitDownload',
							])->first();

		if(!$analytic){
			$mediaKitDownload = MediaKitDownload::create([]);
			$analytic = $mediaKitDownload->stats()
							->create([
								'media_kit_id' => $data['media_kit_id'],
								'journalist_id' => $data['journalist_id'],
							]);
		}

		$notification = Notification::where([
										'user_id' => $data['architect_user_id'],
										'notifiable_id' => $analytic->id,
									])->first();

		if(!$notification){
			$subject = 'Journalist downloaded your media kit';
			$message = '<a href="' . route('architect.pitch-story.journalists.view', ['journalist' => $data['journalist_slug']]) . '" class="text-purple-700">' . $data['journalist_name'] . '</a> downloaded your Media Kit <a href="' . route('architect.media-kit.view', ['mediaKit' => $data['media_kit_slug']]) . '" class="text-purple-700">' . $data['media_kit_title'] . '</a>';
			$notification = $analytic->notification()
										->create([
											'user_id' => $data['architect_user_id'],
											'subject' => $subject,
											'message' => $message,
										]);
		}
	}

	public static function sendTeamInviteNotification(array $data)
	{
		$subject = $data['invited_by'];
		$message = 'Invited <span class="text-purple-700">' . $data['invited_to'] . '</span> to the team.';
		$users = [];
		if($data['type'] === 'architect'){
			$company = $data['poly']->user->architect->company;
			$users = $company->architects;
		}
		foreach($users as $user){
			if($user->user_role === UserRoleEnum::ADMIN){
				$data['poly']->notification()
								->create([
									'user_id' => $user->user_id,
									'subject' => $subject,
									'message' => $message,
								]);
			}
		}
	}

	public function sendTeamAddNotification()
	{

	}

	public function sendDownloadRequestNotification(array $data)
	{
		$subject = 'Download request';
		$message = '<a href="' . route('architect.pitch-story.journalists.view', ['journalist' => $data['journalist_slug']]) . '" class="text-purple-700">' . $data['journalist_name'] . '</a> would like to download the media kit <a href="' . route('architect.media-kit.view', ['mediaKit' => $data['media_kit_slug']]) . '" class="text-purple-700">' . $data['media_kit_title'] . '</a>.';

		$data['poly']->notification()
						->create([
							'user_id' => $data['architect_user_id'],
							'subject' => $subject,
							'message' => $message,
						]);
	}

	public static function sendApprovedDownloadRequestNotification(array $data)
	{
		$subject = 'Download request approved';
		$message = '<a href="' . route('journalist.brand.architect', ['architect' => $data['architect_slug']]) . '" class="text-purple-700">' . $data['architect_name'] . '</a> granted you download access to <a href="' . route('journalist.media-kit.view', ['mediaKit' => $data['media_kit_slug']]) . '" class="text-purple-700">' . $data['media_kit_title'] . '</a>.';
		$data['poly']->notification()
						->create([
							'user_id' => $data['journalist_user_id'],
							'subject' => $subject,
							'message' => $message,
						]);
	}

	public static function sendDeclinedDownloadRequestNotification(array $data)
	{
		$subject = 'Download request declined';
		$message = '<a href="' . route('journalist.brand.architect', ['architect' => $data['architect_slug']]) . '" class="text-purple-700">' . $data['architect_name'] . '</a> declined your download request to <a href="' . route('journalist.media-kit.view', ['mediaKit' => $data['media_kit_slug']]) . '" class="text-purple-700">' . $data['media_kit_title'] . '</a>.';
		$data['poly']->notification()
						->create([
							'user_id' => $data['journalist_user_id'],
							'subject' => $subject,
							'message' => $message,
						]);
	}

	public static function sendMessageSentNotification(array $data)
	{
		$subject = '<span class="text-dark fw-semibold">' . $data['sent_by'] . '</span>' . ' <span class="text-secondary">sent you a message</span>';
		$message = $data['message'];
		$data['poly']->notification()
						->create([
							'user_id' => $data['sent_to_user_id'],
							'subject' => $subject,
							'message' => $message,
						]);
	}

	public static function sendMediaKitOnCallNotification(array $data)
	{
		$subject = 'Received call response';
		$message = '<span class="text-secondary">Responded to your call for submissions on <a href="' . route('journalist.call.view', ['call' => $data['call_slug']]) . '" class="text-purple-700 fw-medium">' . $data['call_title'] . '</a></span>';
		$data['poly']->notification()
						->create([
							'user_id' => $data['sent_to_user_id'],
							'subject' => $subject,
							'message' => $message,
						]);
	}

	public static function sendMediaKitNotification(array $data)
	{
		$subject = '<span class="text-secondary">Sent you a new ' . $data['media_kit_type'] . ' <a href="' . route('journalist.media-kit.view', ['mediaKit' => $data['media_kit_slug']]) . '" class="text-purple-700">' . $data['media_kit_title'] . '</a></span>';
		$message = $data['message'];
		$data['poly']->notification()
						->create([
							'user_id' => $data['sent_to_user_id'],
							'subject' => $subject,
							'message' => $message,
						]);
	}

	public function sendFileAddedNotification()
	{

	}
}
