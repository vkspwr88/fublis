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
			<div class="form-check form-check-inline">
				<input class="form-check-input filter-checkbox" type="checkbox" value="{{ $downloadRequest->notifiable->id }}" id="" wire:model="selectedRequests" />
				<label class="form-check-label" for=""></label>
			</div>
		</div>
	</div>
</div>
