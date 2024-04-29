<div class="row g-3 align-items-center">
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
			{!! $notification->message !!}
		</p>
	</div>
</div>
