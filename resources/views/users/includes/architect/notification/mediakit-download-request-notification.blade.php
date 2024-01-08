<div class="row g-3 align-items-center">
	<div class="col-auto">
		<img class="img-square rounded-circle" src="{{ $notification->notifiable->requestedJournalist->journalist->profileImage ? Storage::url($notification->notifiable->requestedJournalist->journalist->profileImage->image_path) : 'https://via.placeholder.com/48x48' }}" alt="..." />
	</div>
	<div class="col-auto">
		<p class="m-0 p-0">
			{!! $notification->message !!}
		</p>
	</div>
	<div class="col text-end">
		@php
			use App\Enums\Users\Architects\MediaKits\RequestStatusEnum;
		@endphp
		@if ($notification->notifiable->request_status === RequestStatusEnum::PENDING)
		<button type="button" class="btn btn-white text-dark fw-semibold me-2" wire:click="declineMediaKitDownload('{{ $notification->id }}')">
			Decline <x-users.spinners.primary-btn wire:target="declineMediaKitDownload('{{ $notification->id }}')" />
		</button>
		<button type="button" class="btn btn-primary" wire:click="approveMediaKitDownload('{{ $notification->id }}')">
			Approve <x-users.spinners.white-btn wire:target="approveMediaKitDownload('{{ $notification->id }}')" />
		</button>
		@elseif ($notification->notifiable->request_status === RequestStatusEnum::APPROVED)
		<p class="m-0 p-0 text-success text-uppercase">{{ RequestStatusEnum::APPROVED }}</p>
		@elseif ($notification->notifiable->request_status === RequestStatusEnum::DECLINED)
		<p class="m-0 p-0 text-danger text-uppercase">{{ RequestStatusEnum::DECLINED }}</p>
		@endif
	</div>
</div>
