<div class="row g-3">
	<div class="col-auto">
		<img class="img-square rounded-circle img-48" src="{{ $notification->notifiable->user->architect->profileImage ? Storage::url($notification->notifiable->user->architect->profileImage->image_path) : 'https://via.placeholder.com/48x48' }}" alt="..." />
	</div>
	<div class="col">
		<p class="m-0 p-0">
			<span class="text-dark fw-semibold">{{ $notification->notifiable->user->name }}</span>
			<span class="text-secondary">2:20pm</span>
		</p>
		<p class="m-0 p-0 mb-1 text-secondary">Sent you a message</p>
		<p class="m-0 p-0">
			"{!! $notification->message !!}"
		</p>
	</div>
	<div class="col text-end">
		<a href="{{ route('journalist.account.profile.message.index', ['chat' => $notification->notifiable->chat_id, 'chatMessage' => $notification->notifiable->id]) }}" class="btn btn-primary">View Message</a>
	</div>
</div>
