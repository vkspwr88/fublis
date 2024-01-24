<div class="col-12">
	<div class="row g-3 align-items-center">
		<div class="col-auto">
			<img class="img-square img-48 rounded-circle" src="{{ $downloadRequest->notifiable->requestedJournalist->journalist->profileImage ? Storage::url($downloadRequest->notifiable->requestedJournalist->journalist->profileImage->image_path) : 'https://via.placeholder.com/48x48' }}" alt="..." />
		</div>
		<div class="col-auto">
			<p class="m-0 p-0 text-purple-700">{{ $downloadRequest->notifiable->mediaKit->story->title }}</p>
			<p class="m-0 p-0 text-secondary">{{ $studioName }}</p>
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
