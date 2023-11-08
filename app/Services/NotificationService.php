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
			$message = 'Receives view count of <a href="' . route('architect.journalist', ['journalist_id' => $data['journalist_id']]) . '" class="text-purple-700">' . $data['journalist_name'] . '</a> of his Media Kit <a href="' . route('architect.media-kit.view', ['media_kit' => $data['media_kit_id']]) . '" class="text-purple-700">' . $data['media_kit_title'] . '</a>';
			$notification = $analytic->notification()
										->create([
											'user_id' => $data['architect_user_id'],
											'message' => $message,
										]);
		}
	}
}
