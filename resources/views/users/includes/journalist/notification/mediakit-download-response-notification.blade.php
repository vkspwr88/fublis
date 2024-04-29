<div class="row g-3 align-items-center">
	<div class="col-auto">
		@php
			$profileImg = $notification->notifiable->mediaKit->architect->profileImage ?
											Storage::url($notification->notifiable->mediaKit->architect->profileImage->image_path) :
											App\Http\Controllers\Users\AvatarController::setProfileAvatar([
												'name' => $notification->notifiable->mediaKit->architect->user->name,
												'width' => 150,
												'fontSize' => 60,
												'background' => $notification->notifiable->mediaKit->architect->background_color,
												'foreground' => $notification->notifiable->mediaKit->architect->foreground_color,
											]);
		@endphp
		<img class="img-square rounded-circle img-48" src="{{ $profileImg }}" alt="..." />
	</div>
	<div class="col-auto">
		<p class="p-0 m-0">
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
