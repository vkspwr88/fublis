<?php

namespace App\Services;

use App\Models\DownloadRequestSchedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class DownloadRequestScheduleService
{
	public static function create(array $details)
	{
		return DownloadRequestSchedule::create(
			self::filterDetails($details)
		);
	}

	public static function getRecordsByNowAndMailNotSent()
	{
		$startDate = Carbon::now();
		$endDate = Carbon::now()->addMinutes(70);
		return DownloadRequestSchedule::with([
				'user',
				'mediaKit'
			])
			->whereBetween('schedule_at', [$startDate, $endDate])
			->where('is_mail_sent', false)
			->get();
	}

	public static function update(DownloadRequestSchedule $downloadRequestSchedule, array $details)
	{
		return $downloadRequestSchedule->update(
			self::filterDetails($details)
		);
	}

	public static function filterDetails($details)
	{
		return Arr::only($details, ['user_id', 'media_kit_id', 'schedule_at', 'is_mail_sent']);
	}
}
