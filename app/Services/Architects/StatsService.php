<?php

namespace App\Services\Architects;

use App\Http\Controllers\DateController;
use App\Http\Controllers\Users\ArchitectController;
use App\Mail\User\Architect\MonthlyStatsMail;
use App\Mail\User\Architect\WeeklyStatsMail;
use Illuminate\Support\Facades\Mail;

class StatsService
{
	public function sendStatEmails($statsType)
	{
		$dateRange = DateController::getDateRange($statsType);
		$architects = ArchitectController::getAll();
		$architects->load([
			'mediaKits' => [
				'pitch',
				'analytics',
			]
		]);
		foreach($architects as $architect){
			$resultData = [
				'total_media_kits' => 0,
				'total_pitches_sent' => 0,
				'total_views' => 0,
				'total_downloads' => 0,
			];
			$mediaKits = $architect->mediaKits;
			$pitches = $mediaKits->pluck('pitch')->flatten();
			$analytics = $mediaKits->pluck('analytics')->flatten()->whereBetween('created_at', [$dateRange['from_date'], $dateRange['to_date']]);
			// dd($analytics);
			$resultData['total_media_kits'] = $mediaKits->whereBetween('created_at', [$dateRange['from_date'], $dateRange['to_date']])->count();
			$resultData['total_pitches_sent'] = $pitches->whereBetween('created_at', [$dateRange['from_date'], $dateRange['to_date']])->count();
			$resultData['total_views'] = $analytics->where('data_type', 'App\Models\MediaKitView')->count();
			$resultData['total_downloads'] = $analytics->where('data_type', 'App\Models\MediaKitDownload')->count();
			// dd($dateRange['from_date'], $dateRange['to_date'], $resultData, $architect->mediaKits);
			if($statsType == 'week'){
				Mail::to($architect->user->email)->queue(new WeeklyStatsMail($architect->user->email, $architect->user->name, $resultData));
			}
			elseif($statsType == 'month'){
				Mail::to($architect->user->email)->queue(new MonthlyStatsMail($architect->user->email, $architect->user->name, $resultData));
			}
		}
	}
}