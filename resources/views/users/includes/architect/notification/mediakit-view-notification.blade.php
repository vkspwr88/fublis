<div class="row g-3 align-items-center">
	<div class="col-auto">
		<img class="img-square rounded-circle img-48" src="{{ $notification->notifiable->user->journalist->profileImage ? Storage::url($notification->notifiable->user->journalist->profileImage->image_path) : 'https://via.placeholder.com/48x48' }}" alt="..." />
	</div>
	<div class="col">
		<p class="m-0 p-0">
			{!! $notification->message !!}
		</p>
	</div>
</div>
