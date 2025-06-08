<?php

namespace App\Services;

use App\Enums\Users\Architects\MediaKits\RequestStatusEnum;
use App\Models\DownloadRequest;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;

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

	public static function getPendingRequestsQuery()
	{
		return Notification::where('user_id', auth()->id())
			->whereHasMorph(
				'notifiable',
				DownloadRequest::class,
				function (Builder $query) {
					// dd($query);
					$query->where('request_status', RequestStatusEnum::PENDING);
				}
			)
			->with([
				'notifiable' => function (MorphTo $morphTo) {
					$morphTo->morphWith([
						DownloadRequest::class => [
							'requestedJournalist' => [
								'journalist' => [
									'publications',
									'profileImage',
								]
							],
							'mediaKit' => [
								'story',
							]
						],
					]);
				}
			]);
	}

	public static function getAllRequestsQuery()
	{
		return Notification::where('user_id', auth()->id())
			->whereHasMorph(
				'notifiable',
				DownloadRequest::class
			)
			->with([
				'notifiable' => function (MorphTo $morphTo) {
					$morphTo->morphWith([
						DownloadRequest::class => [
							'requestedJournalist' => [
								'journalist' => [
									'publications',
									'profileImage',
								]
							],
							'mediaKit' => [
								'story',
							]
						],
					]);
				}
			]);
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