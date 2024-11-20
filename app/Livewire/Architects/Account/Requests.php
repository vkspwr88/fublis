<?php

namespace App\Livewire\Architects\Account;

use App\Enums\Users\Architects\MediaKits\RequestStatusEnum;
use App\Http\Controllers\Users\Architects\DownloadController;
use App\Models\DownloadRequest;
use App\Models\Notification;
use App\Services\DownloadRequestService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Requests extends Component
{
	public $pendingDownloadRequest;
	public $studioName;

	public function mount()
	{
		$this->studioName = Auth::user()->architect->company->name;
		$this->pendingDownloadRequest = collect();
		$this->pendingDownloadRequest = DownloadRequestService::getPendingRequestsQuery()->latest()->get();
	}

    public function render()
    {
		// dd($this->pendingDownloadRequest);
        return view('livewire.architects.account.requests');
    }

	public function approveMediaKitDownload($notificationId, $showAll = false)
	{
		$notification = $this->pendingDownloadRequest->find($notificationId);
		if(!DownloadController::isAllowedToRespond()){
			$this->dispatch('show-download-request-modal');
			return;
		}
		if(DownloadController::approveRequest($notification->notifiable)){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully approved the download request.'
			]);
			// if($showAll){
			// 	$this->updatePendingRequest();
			// }
			return;
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in approving the download request. Please try again or contact support.'
		]);
	}

	public function declineMediaKitDownload($notificationId, $showAll = false)
	{
		$notification = $this->pendingDownloadRequest->find($notificationId);
		if(!DownloadController::isAllowedToRespond()){
			$this->dispatch('show-download-request-modal');
			return;
		}
		if(DownloadController::declineRequest($notification->notifiable)){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully declined the download request.'
			]);
			// if($showAll){
			// 	$this->updatePendingRequest();
			// }
			return;
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in declining the download request. Please try again or contact support.'
		]);
	}

	// public function updatePendingRequest()
	// {
	// 	$this->pendingDownloadRequest = $this->notifications->filter( function($item) {
	// 		return $item->notifiable instanceof Models\DownloadRequest && $item->notifiable->request_status === RequestStatusEnum::PENDING;
	// 	});
	// }
}
