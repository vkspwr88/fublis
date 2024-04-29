<div class="row g-3">
	<div class="col-auto">
		@php
			$profileImg = $notification->notifiable->pitch->mediaKit->architect->profileImage ?
											Storage::url($notification->notifiable->pitch->mediaKit->architect->profileImage->image_path) :
											App\Http\Controllers\Users\AvatarController::setProfileAvatar([
												'name' => $notification->notifiable->pitch->mediaKit->architect->user->name,
												'width' => 150,
												'fontSize' => 60,
												'background' => $notification->notifiable->pitch->mediaKit->architect->background_color,
												'foreground' => $notification->notifiable->pitch->mediaKit->architect->foreground_color,
											]);
		@endphp
		<img class="img-square rounded-circle img-48" src="{{ $profileImg }}" alt="..." />
	</div>
	<div class="col text-truncate">
		<p class="p-0 m-0">
			<span class="text-dark fw-semibold">{{ $notification->notifiable->pitch->mediaKit->architect->user->name }}</span>
			<span class="text-secondary">{{ formatDateTime($notification->created_at) }}</span>
		</p>
		<p class="p-0 m-0 mb-1">{!! $notification->subject !!}</p>
		<p class="p-0 m-0">
			"{!! $notification->message !!}"
		</p>
	</div>
	<div class="col text-end">
		<a href="{{ route('journalist.media-kit.view', ['mediaKit' => $notification->notifiable->pitch->mediaKit->slug]) }}" class="btn btn-primary fs-6 fw-medium">View Media Kit</a>
		<a href="{{ route('journalist.account.profile.message.index', ['chat' => $notification->notifiable->id]) }}" class="btn btn-primary fs-6 fw-medium">Read Full Message</a>
	</div>
</div>
