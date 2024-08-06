<?php

namespace App\Services;

use App\Models\DownloadRequest;
use Carbon\Carbon;

class DownloadRequestService
{
	public static function getTodayPendingRequests()
	{
		$startDate = Carbon::now()->startOfDay();
		$endDate = Carbon::now()->endOfDay();
		return DownloadRequest::where('request_status', 'pending')
			->whereBetween('created_at', [$startDate, $endDate])
			->get();
	}

	public static function loadModel($model)
	{
		return $model->load([
			'mediaKit' => [
				'story',
				'architect' => [
					'user',
				],
			],
		]);
	}
}
