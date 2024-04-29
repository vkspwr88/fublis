<div class="row g-3">
	<div class="col-auto">
		@php
			$profileImg = $notification->notifiable->user->journalist->profileImage ?
											Storage::url($notification->notifiable->user->journalist->profileImage->image_path) :
											App\Http\Controllers\Users\AvatarController::setProfileAvatar([
												'name' => $notification->notifiable->user->name,
												'width' => 150,
												'fontSize' => 60,
												'background' => $notification->notifiable->user->journalist->background_color,
												'foreground' => $notification->notifiable->user->journalist->foreground_color,
											]);
		@endphp
		<img class="img-square rounded-circle img-48" src="{{ $profileImg }}" alt="..." />
	</div>
	<div class="col">
		<p class="p-0 m-0">
			<span class="text-dark fw-semibold">{{ $notification->notifiable->user->name }}</span>
			<span class="text-secondary">{{ formatDateTime($notification->created_at) }}</span>
		</p>
		<p class="p-0 m-0 mb-1 text-secondary">Sent you a message</p>
		<p class="p-0 m-0">
			"{{ strip_tags($notification->message) }}"
			{{-- "{!! $notification->message !!}" --}}
		</p>
	</div>
</div>
