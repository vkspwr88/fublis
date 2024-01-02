<?php

namespace App\Services;

use App\Models\Analytic;
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
			$message = 'Receives view count of <a href="' . route('architect.journalist', ['journalist_id' => $data['journalist_slug']]) . '" class="text-purple-700">' . $data['journalist_name'] . '</a> of his Media Kit <a href="' . route('architect.media-kit.view', ['media_kit' => $data['media_kit_slug']]) . '" class="text-purple-700">' . $data['media_kit_title'] . '</a>';
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
		if($data['type'] === 'architect'){
			$company = $data['poly']->user->architect->company;
			$users = $company->architects;
		}
		foreach($users as $user){
			$data['poly']->notification()
							->create([
								'user_id' => $user->user_id,
								'subject' => $subject,
								'message' => $message,
							]);
		}

	}

	public static function sendTeamAddNotification()
	{

	}

	public static function sendDownloadRequestNotification()
	{

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

	public static function sendFileAddedNotification()
	{

	}
}
