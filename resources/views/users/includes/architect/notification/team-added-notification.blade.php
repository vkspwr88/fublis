<div class="row g-3">
	<div class="col-auto">
		@php
			$profileImg = $notification->notifiable->user->architect->profileImage ?
											Storage::url($notification->notifiable->user->architect->profileImage->image_path) :
											App\Http\Controllers\Users\AvatarController::setProfileAvatar([
												'name' => $notification->notifiable->user->name,
												'width' => 150,
												'fontSize' => 60,
												'background' => $notification->notifiable->user->architect->background_color,
												'foreground' => $notification->notifiable->user->architect->foreground_color,
											]);
		@endphp
		<img class="img-square rounded-circle img-48" src="{{ $profileImg }}" alt="..." />
	</div>
	<div class="col">
		<p class="p-0 m-0">
			<span class="text-dark fw-semibold">{{ $notification->notifiable->user->name }}</span>
			<span class="text-secondary">{{ formatDateTime($notification->created_at) }}</span>
		</p>
		<p class="p-0 m-0">
			{!! $notification->message !!}
		</p>
	</div>
</div>
