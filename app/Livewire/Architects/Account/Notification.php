<?php

namespace App\Livewire\Architects\Account;

use App\Enums\Users\Architects\MediaKits\RequestStatusEnum;
use App\Http\Controllers\Users\Architects\DownloadController;
use App\Models;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Livewire\Component;

class Notification extends Component
{
	public $notifications;
	public $todayNotifications;
	public $thisWeekNotifications;
	public $thisMonthNotifications;
	public $isRequestWindowDisplay = false;
	public $isManageRequestWindowDisplay = false;
	public $pendingDownloadRequest;
	public $studioName;
	public $selectedRequests = [];

	public function mount()
	{
		$this->studioName = auth()->user()->architect->company->name;
		$this->pendingDownloadRequest = collect();
		$this->notifications = Models\Notification::where('user_id', auth()->id())
													->with([
														'notifiable' => function (MorphTo $morphTo) {
															$morphTo->morphWith([
																Models\Analytic::class => [
																	'user' => [
																		'journalist' => [
																			'profileImage'
																		],
																	],
																	'mediaKit',
																],
																Models\DownloadRequest::class => [
																	'requestedJournalist' => [
																		'journalist' => [
																			'profileImage'
																		]
																	],
																	'mediaKit' => [
																		'story',
																	]
																],
																Models\ChatMessage::class => [
																	'user' => [
																		'journalist' => [
																			'profileImage'
																		]
																	]
																],
																Models\InviteColleague::class => [
																	'user' => [
																		'architect' => [
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
		//dd($this->notifications);
		return view('livewire.architects.account.notification');
    }

	public function approveMediaKitDownload($notificationId, $showAll = false)
	{
		$notification = $this->notifications->find($notificationId);
		//dd($this->notifications, $notification);
		if(DownloadController::approveRequest($notification->notifiable)){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully approved the download request.'
			]);
			if($showAll){
				$this->updatePendingRequest();
			}
			return;
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in approving the download request. Please try again or contact support.'
		]);
	}

	public function declineMediaKitDownload($notificationId, $showAll = false)
	{
		$notification = $this->notifications->find($notificationId);
		//dd($this->notifications, $notification);
		if(DownloadController::declineRequest($notification->notifiable)){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully declined the download request.'
			]);
			if($showAll){
				$this->updatePendingRequest();
			}
			return;
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in declining the download request. Please try again or contact support.'
		]);
	}

	public function updatePendingRequest()
	{
		$this->pendingDownloadRequest = $this->notifications->filter( function($item) {
			return $item->notifiable instanceof Models\DownloadRequest && $item->notifiable->request_status === RequestStatusEnum::PENDING;
		});
	}

	public function showAllRequest()
	{
		$this->updatePendingRequest();
		$this->isRequestWindowDisplay = true;
	}



	public function hideAllRequest()
	{
		$this->isRequestWindowDisplay = false;
		$this->isManageRequestWindowDisplay = false;
		$this->selectedRequests = [];
	}

	public function showManageAllRequest()
	{
		$this->isRequestWindowDisplay = false;
		$this->isManageRequestWindowDisplay = true;
	}

	public function selectAllRequest()
	{
		$this->selectedRequests = $this->pendingDownloadRequest->pluck('id')->all();
	}

	public function approveSelectedMediaKitDownload()
	{
		if(empty($this->selectedRequests)){
			$this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Select atleast one request.'
			]);
			return;
		}

		if(DownloadController::approveBulkRequest($this->selectedRequests)){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully approved the download request.'
			]);
			$this->updatePendingRequest();
			$this->selectedRequests = [];
			return;
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in approving the download request. Please try again or contact support.'
		]);
	}

	public function declineSelectedMediaKitDownload()
	{
		//dd($this->selectedRequests, empty($this->selectedRequests));
		if(empty($this->selectedRequests)){
			$this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Select atleast one request.'
			]);
		}
		if(DownloadController::declineBulkRequest($this->selectedRequests)){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully declined the download request.'
			]);
			$this->updatePendingRequest();
			$this->selectedRequests = [];
			return;
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in declining the download request. Please try again or contact support.'
		]);
	}
}
