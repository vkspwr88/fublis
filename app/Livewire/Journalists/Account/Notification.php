<?php

namespace App\Livewire\Journalists\Account;

use Livewire\Component;
use App\Models;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Notification extends Component
{
	public $notifications;
	public $todayNotifications;
	public $thisWeekNotifications;
	public $thisMonthNotifications;

	public function mount()
	{
		$this->notifications = Models\Notification::where('user_id', auth()->id())
													->with([
														'notifiable' => function (MorphTo $morphTo) {
															$morphTo->morphWith([
																Models\DownloadRequest::class => [
																	'requestedJournalist' => [
																		'journalist' => [
																			'profileImage'
																		]
																	],
																	'mediaKit' => [
																		'architect' => [
																			'user',
																			'profileImage'
																		]
																	]
																],
																Models\ChatMessage::class => [
																	'user' => [
																		'architect' => [
																			'profileImage'
																		]
																	]
																],
																Models\Chat::class => [
																	'pitch' => [
																		'mediaKit' => [
																			'architect' => [
																				'user',
																				'profileImage'
																			],
																		],
																	],
																	/* 'user' => [
																		'architect' => [
																			'profileImage'
																		]
																	] */
																],
																Models\Pitch::class => [
																	'mediaKit' => [
																		'architect' => [
																			'user',
																			'profileImage'
																		]
																	]
																],
															]);
														}
													])
													->latest()
													->get();

		$dateNow = CarbonImmutable::now();
		$startDate = $dateNow->startOfDay();
		$endDate = $dateNow->endOfDay();
		//dd($dateNow, $startDate, $endDate);
		$this->todayNotifications = $this->notifications
											->whereBetween('created_at', [
												$startDate,
												$endDate
											]);

		//$startWeek = $startDate->addDay();
		$endWeek = $endDate->subDay();
		$startWeek = $endWeek->subDays(7);
		//dd($startDate, $endDate, $startWeek, $endWeek);
		$this->thisWeekNotifications = $this->notifications
											->whereBetween('created_at', [
												$startWeek->addMinute(),
												$endWeek
											]);

		//$startMonth = $endWeek;
		$endMonth = $startWeek;
		$startMonth = $endMonth->subDays(24);
		//dd($startDate, $endDate, $startWeek, $endWeek, $startMonth, $endMonth);
		$this->thisMonthNotifications = $this->notifications
												->whereBetween('created_at', [
													$startMonth->addMinute(),
													$endMonth
												]);

		//dd($this->notifications, $this->todayNotifications, $this->thisWeekNotifications, $this->thisMonthNotifications);
	}

    public function render()
    {
        return view('livewire.journalists.account.notification');
    }
}
