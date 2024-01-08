<div class="row g-3 align-items-center">
	<div class="col-auto">
		<img class="img-square rounded-circle" src="{{ $notification->notifiable->mediaKit->architect->profileImage ? Storage::url($notification->notifiable->mediaKit->architect->profileImage->image_path) : 'https://via.placeholder.com/48x48' }}" alt="..." />
	</div>
	<div class="col-auto">
		<p class="m-0 p-0">
			{!! $notification->message !!}
		</p>
	</div>
	@php
		use App\Enums\Users\Architects\MediaKits\RequestStatusEnum;
	@endphp
	@if ($notification->notifiable->request_status === RequestStatusEnum::APPROVED)
	<div class="col text-end">
		<a href="{{ route('journalist.media-kit.view', ['mediaKit' => $notification->notifiable->mediaKit->slug]) }}" class="btn btn-primary">View Media Kit</a>
	</div>
	@endif
</div>
