<div class="row g-3">
	<div class="col-auto">
		<img class="img-square rounded-circle img-48" src="{{ $notification->notifiable->mediaKit->architect->profileImage ? Storage::url($notification->notifiable->mediaKit->architect->profileImage->image_path) : 'https://via.placeholder.com/48x48' }}" alt="..." />
	</div>
	@if ($notification->notifiable->pitchable instanceof App\Models\Call)
		<div class="col-auto">
			<p class="m-0 p-0">
				<span class="text-dark fw-semibold">{{ $notification->notifiable->mediaKit->architect->user->name }}</span>
				<span class="text-secondary">2:20pm</span>
			</p>
			<p class="m-0 p-0">{!! $notification->message !!}</p>
		</div>
		<div class="col text-end">
			<a href="{{ route('journalist.media-kit.view', ['mediaKit' => $notification->notifiable->mediaKit->slug]) }}" class="btn btn-primary">View Media Kit</a>
		</div>
	@else
		{{-- <div class="col text-truncate">
			<p class="m-0 p-0">
				<span class="text-dark fw-semibold">{{ $notification->notifiable->mediaKit->architect->user->name }}</span>
				<span class="text-secondary">2:20pm</span>
			</p>
			<p class="m-0 p-0 mb-1">{!! $notification->subject !!}</p>
			<p class="m-0 p-0">
				"{!! $notification->message !!}"
			</p>
		</div>
		<div class="col text-end">
			<a href="{{ route('journalist.media-kit.view', ['mediaKit' => $notification->notifiable->mediaKit->slug]) }}" class="btn btn-primary fs-6 fw-medium">View Media Kit</a>
			<a href="{{ route('journalist.account.profile.message.index', ['chat' => $notification->notifiable->mediaKit->slug]) }}" class="btn btn-primary fs-6 fw-medium">Read Full Message</a>
		</div> --}}
	@endif
</div>
