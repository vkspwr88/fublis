<div class="col-12">
	<div class="row g-3 align-items-center">
		<div class="col-auto">
			@php
				$profileImg = $notification->notifiable->requestedJournalist->journalist->profileImage ?
												Storage::url($notification->notifiable->requestedJournalist->journalist->profileImage->image_path) :
												App\Http\Controllers\Users\AvatarController::setProfileAvatar([
													'name' => $notification->notifiable->requestedJournalist->journalist->user->name,
													'width' => 150,
													'fontSize' => 60,
													'background' => $notification->notifiable->requestedJournalist->journalist->background_color,
													'foreground' => $notification->notifiable->requestedJournalist->journalist->foreground_color,
												]);
			@endphp
			<img class="img-square img-48 rounded-circle" src="{{ $profileImg }}" alt="..." />
		</div>
		<div class="col-auto">
			<p class="p-0 m-0 text-purple-700">{{ $downloadRequest->notifiable->mediaKit->story->title }}</p>
			<p class="p-0 m-0 text-secondary">{{ $studioName }}</p>
		</div>
		<div class="col text-end">
			<div class="form-check form-check-inline">
				<input class="form-check-input filter-checkbox" type="checkbox" value="{{ $downloadRequest->notifiable->id }}" id="" wire:model="selectedRequests" />
				<label class="form-check-label" for=""></label>
			</div>
		</div>
	</div>
</div>
