<?php

namespace App\Services\Journalists;

use App\Http\Controllers\DateController;
use App\Http\Controllers\Users\JournalistController;
use App\Mail\User\Journalist\MonthlyStatsMail;
use App\Mail\User\Journalist\WeeklyStatsMail;
use Illuminate\Support\Facades\Mail;

class StatsService
{
	public function sendStatEmails($statsType)
	{
		$dateRange = DateController::getDateRange($statsType);
		$journalists = JournalistController::getAll();
		$journalists->load([
			'pitches',
			'calls' => [
				'pitches',
				'callViews',
			]
		]);
		foreach($journalists as $journalist){
			$resultData = [
				'total_pitches_received' => 0,
				'total_calls_created' => 0,
				'total_views' => 0,
				'total_submissions_received' => 0,
			];
			$pitches = $journalist->pitches;
			$calls = $journalist->calls;
			$submissions = $calls->pluck('pitch')->flatten();
			$callViews = $calls->pluck('callViews')->flatten()->whereBetween('created_at', [$dateRange['from_date'], $dateRange['to_date']]);
			// dd($analytics);
			$resultData['total_pitches_received'] = $pitches->whereBetween('created_at', [$dateRange['from_date'], $dateRange['to_date']])->count();
			$resultData['total_calls_created'] = $calls->whereBetween('created_at', [$dateRange['from_date'], $dateRange['to_date']])->count();
			$resultData['total_views'] = $callViews->whereBetween('created_at', [$dateRange['from_date'], $dateRange['to_date']])->count();
			$resultData['total_submissions_received'] = $submissions->whereBetween('created_at', [$dateRange['from_date'], $dateRange['to_date']])->count();
			// dd($dateRange['from_date'], $dateRange['to_date'], $resultData, $architect->mediaKits);
			if($statsType == 'week'){
				Mail::to($journalist->user->email)->queue(new WeeklyStatsMail($journalist->user->email, $journalist->user->name, $resultData));
			}
			elseif($statsType == 'month'){
				Mail::to($journalist->user->email)->queue(new MonthlyStatsMail($journalist->user->email, $journalist->user->name, $resultData));
			}
		}
	}
}