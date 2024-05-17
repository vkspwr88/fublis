<div class="row g-3">
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
	@if ($notification->notifiable->pitchable instanceof App\Models\Call)
		<div class="col-auto">
			<p class="p-0 m-0">
				<span class="text-dark fw-semibold">{{ $notification->notifiable->mediaKit->architect->user->name }}</span>
				<span class="text-secondary">{{ formatDateTime($notification->created_at) }}</span>
			</p>
			<p class="p-0 m-0">{!! $notification->message !!}</p>
		</div>
		<div class="col text-end">
			<a href="{{ route('journalist.media-kit.view', ['mediaKit' => $notification->notifiable->mediaKit->slug]) }}" class="btn btn-primary">View Media Kit</a>
		</div>
	@elseif ($notification->notifiable->pitchable instanceof App\Models\Journalist)
		<div class="col-auto">
			<p class="p-0 m-0">
				<span class="text-dark fw-semibold">{{ $notification->notifiable->mediaKit->architect->user->name }}</span>
				<span class="text-secondary">{{ formatDateTime($notification->created_at) }}</span>
			</p>
			<p class="p-0 m-0">{!! $notification->message !!}</p>
		</div>
		<div class="col text-end">
			<a href="{{ route('journalist.media-kit.view', ['mediaKit' => $notification->notifiable->mediaKit->slug]) }}" class="btn btn-primary">View Media Kit</a>
		</div>
	@elseif ($notification->notifiable->pitchable instanceof App\Models\Publication)
		<div class="col-auto">
			<p class="p-0 m-0">
				<span class="text-dark fw-semibold">{{ $notification->notifiable->mediaKit->architect->user->name }}</span>
				<span class="text-secondary">{{ formatDateTime($notification->created_at) }}</span>
			</p>
			<p class="p-0 m-0">{!! $notification->message !!}</p>
		</div>
		<div class="col text-end">
			<a href="{{ route('journalist.media-kit.view', ['mediaKit' => $notification->notifiable->mediaKit->slug]) }}" class="btn btn-primary">View Media Kit</a>
		</div>
	@else
		{{-- <div class="col text-truncate">
			<p class="p-0 m-0">
				<span class="text-dark fw-semibold">{{ $notification->notifiable->mediaKit->architect->user->name }}</span>
				<span class="text-secondary">{{ formatDateTime($notification->created_at) }}</span>
			</p>
			<p class="p-0 m-0 mb-1">{!! $notification->subject !!}</p>
			<p class="p-0 m-0">
				"{!! $notification->message !!}"
			</p>
		</div>
		<div class="col text-end">
			<a href="{{ route('journalist.media-kit.view', ['mediaKit' => $notification->notifiable->mediaKit->slug]) }}" class="btn btn-primary fs-6 fw-medium">View Media Kit</a>
			<a href="{{ route('journalist.account.profile.message.index', ['chat' => $notification->notifiable->mediaKit->slug]) }}" class="btn btn-primary fs-6 fw-medium">Read Full Message</a>
		</div> --}}
	@endif
</div>
