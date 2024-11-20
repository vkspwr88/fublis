<div class="col-12" wire:key="{{ $downloadRequest->id }}">
	<div class="row g-3 align-items-center">
		<div class="col-auto">
			@php
				$profileImg = $downloadRequest->notifiable->requestedJournalist->journalist->profileImage ?
												Storage::url($downloadRequest->notifiable->requestedJournalist->journalist->profileImage->image_path) :
												App\Http\Controllers\Users\AvatarController::setProfileAvatar([
													'name' => $downloadRequest->notifiable->requestedJournalist->journalist->user->name,
													'width' => 150,
													'fontSize' => 60,
													'background' => $downloadRequest->notifiable->requestedJournalist->journalist->background_color,
													'foreground' => $downloadRequest->notifiable->requestedJournalist->journalist->foreground_color,
												]);
			@endphp
			<img class="img-square img-48 rounded-circle" src="{{ $profileImg }}" alt="..." />
		</div>
		<div class="col">
			<p class="p-0 m-0 text-dark">
				<a class="text-purple-700" href="{{ route('architect.pitch-story.journalists.view', ['journalist' => $downloadRequest->notifiable->requestedJournalist->journalist->slug]) }}">{{ $downloadRequest->notifiable->requestedJournalist->name }}</a> from <a class="text-purple-700" href="{{ route('architect.pitch-story.publications.view', ['publication' => $downloadRequest->notifiable->requestedJournalist->journalist->publications[0]->slug]) }}">{{ $downloadRequest->notifiable->requestedJournalist->journalist->publications[0]->name }}</a> has requested to publish <a class="text-purple-700" href="{{ route('architect.media-kit.view', ['mediaKit' => $downloadRequest->notifiable->mediaKit->slug]) }}">{{ $downloadRequest->notifiable->mediaKit->story->title }}</a>
			</p>
			<p class="p-0 m-0 text-secondary">{{ $studioName }}</p>
		</div>
		<div class="col text-end">
			<button type="button" class="btn btn-white text-dark fw-semibold me-2" wire:click="declineMediaKitDownload('{{ $downloadRequest->id }}', true)">
				Decline <x-users.spinners.primary-btn wire:target="declineMediaKitDownload('{{ $downloadRequest->id }}', true)" />
			</button>
			<button type="button" class="btn btn-primary" wire:click="approveMediaKitDownload('{{ $downloadRequest->id }}', true)">
				Approve <x-users.spinners.white-btn wire:target="approveMediaKitDownload('{{ $downloadRequest->id }}', true)" />
			</button>
		</div>
	</div>
</div>
