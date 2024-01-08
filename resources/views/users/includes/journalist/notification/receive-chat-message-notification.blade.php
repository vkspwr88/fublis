<div class="row g-3">
	<div class="col-auto">
		<img class="img-square rounded-circle" src="{{ $notification->notifiable->user->architect->profileImage ? Storage::url($notification->notifiable->architect->profileImage->image_path) : 'https://via.placeholder.com/48x48' }}" alt="..." />
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
</div>
