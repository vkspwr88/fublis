<div class="row g-3">
	<div class="col-auto">
		<img class="img-square rounded-circle img-48" src="{{ $notification->notifiable->pitch->mediaKit->architect->profileImage ? Storage::url($notification->notifiable->pitch->mediaKit->architect->profileImage->image_path) : 'https://via.placeholder.com/48x48' }}" alt="..." />
	</div>
	<div class="col text-truncate">
		<p class="m-0 p-0">
			<span class="text-dark fw-semibold">{{ $notification->notifiable->pitch->mediaKit->architect->user->name }}</span>
			<span class="text-secondary">2:20pm</span>
		</p>
		<p class="m-0 p-0 mb-1">{!! $notification->subject !!}</p>
		<p class="m-0 p-0">
			"{!! $notification->message !!}"
		</p>
	</div>
	<div class="col text-end">
		<a href="{{ route('journalist.media-kit.view', ['mediaKit' => $notification->notifiable->pitch->mediaKit->slug]) }}" class="btn btn-primary fs-6 fw-medium">View Media Kit</a>
		<a href="{{ route('journalist.account.profile.message.index', ['chat' => $notification->notifiable->id]) }}" class="btn btn-primary fs-6 fw-medium">Read Full Message</a>
	</div>

	{{-- <div class="col">
		<p class="m-0 p-0">
			<span class="text-dark fw-semibold">{{ $notification->notifiable->pitch->mediaKit->architect->user->name }}</span>
			<span class="text-secondary">2:20pm</span>
		</p>
		<p class="m-0 p-0 mb-1 text-secondary">Sent you a message</p>
		<p class="m-0 p-0">
			"{!! $notification->message !!}"
		</p>
	</div>
	<div class="col text-end">
		<a href="{{ route('journalist.account.profile.message.index', ['chat' => $notification->notifiable->id]) }}" class="btn btn-primary">Read Full Message</a>
	</div> --}}
</div>