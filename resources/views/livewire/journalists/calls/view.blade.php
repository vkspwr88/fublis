<h2 class="py-2 m-0 text-secondary fs-3 fw-semibold text-capitalize">{{ $title }}</h2>
<p class="py-2 m-0 text-secondary">
	<span class="fw-medium"><i>submitted by</i></span>
	<span class="fw-bold">
		@if(isArchitect())
			<a href="{{ route('architect.pitch-story.journalists.view', ['journalist' => $call->journalist->slug]) }}" class="text-purple-700">{{ $submittedBy }}</a>
		@elseif (isJournalist())
			<a href="{{ route('journalist.account.profile.journalists.view', ['journalist' => $journalistSlug ?? $call->journalist->slug]) }}" class="text-purple-700">{{ $submittedBy }}</a>
		@endif
	</span>
</p>
<hr class="my-3 border-gray-300">
<div class="row g-4">
	<div class="col-md-4">
		<p class="p-0 m-0 text-secondary fw-semibold">Call for Submissions</p>
	</div>
	<div class="col-md-8">{{ $description }}</div>
</div>
<hr class="my-3 border-gray-300">
<div class="mb-3 row g-4">
	<div class="col-md-4">
		<p class="p-0 m-0 text-secondary fw-semibold">Submission Deadline</p>
	</div>
	<div class="col-md-8">{{ formatDate($submissionEndsDate) }}</div>
</div>
<div class="mb-3 row g-4">
	<div class="col-md-4">
		<p class="p-0 m-0 text-secondary fw-semibold">Entries Invited</p>
	</div>
	<div class="col-md-8">{{ str()->headline($publishFrom->name) }}</div>
</div>
<div class="mb-3 row g-4">
	<div class="col-md-4">
		<p class="p-0 m-0 text-secondary fw-semibold">Country</p>
	</div>
	<div class="col-md-8">{{ str()->headline($selectedCountry) }}</div>
</div>
<div class="row g-4">
	<div class="col-md-4">
		<p class="p-0 m-0 text-secondary fw-semibold">Language</p>
	</div>
	<div class="col-md-8">{{ str()->headline($language->name) }}</div>
</div>
<hr class="my-3 border-gray-300">
<div class="row g-4">
	<div class="col-md-4">
		<p class="p-0 m-0 text-secondary fw-semibold">Publication</p>
	</div>
	<div class="col-md-8">
		<div class="row align-items-center">
			<div class="col-auto">
				@php
					use App\Http\Controllers\Users\AvatarController as AvatarController;
					$profileImg = $publication->profileImage ?
									Storage::url($publication->profileImage->image_path) :
									AvatarController::setProfileAvatar([
										'name' => $publication->name,
										'width' => 45,
										'fontSize' => 18,
										'background' => $publication->background_color,
										'foreground' => $publication->foreground_color,
									], 'publication');
				@endphp
				<img class="rounded-circle img-square img-45" src="{{ $profileImg }}" alt=".." />
			</div>
			<div class="col">
				<p class="p-0 m-0 fw-semibold">
					@if(isArchitect())
						<a href="{{ route('architect.pitch-story.publications.view', ['publication' => $publication->slug]) }}" class="text-secondary">{{ $publication->name }}</a>
					@elseif (isJournalist())
						<a href="{{ route('journalist.account.profile.publications.view', ['publication' => $publication->slug]) }}" class="text-secondary">{{ $publication->name }}</a>
					@endif
				</p>
				<p class="p-0 m-0">
					<span class="small">
						<a href="{{ $publication->website }}" target="_blank" class="text-secondary">{{ trimWebsiteUrl($publication->website) }}</a>
					</span></p>
			</div>
		</div>
	</div>
</div>
<hr class="my-3 border-gray-300">
<div class="row g-4">
	<div class="col-md-4">
		<p class="p-0 m-0 text-secondary fw-semibold">Tags</p>
	</div>
	<div class="col-md-8">
		<div class="row justify-content-start gx-1 gy-3">
			<div class="col-auto">
				<span class="text-purple-700 bg-purple-100 badge rounded-pill fw-medium">{{ $category->name }}</span>
			</div>
			<div class="col-auto">
				<span class="text-purple-700 bg-purple-100 badge rounded-pill fw-medium">{{ $language->name }}</span>
			</div>
			{{-- <div class="col-auto">
				<span class="text-purple-700 bg-purple-100 badge rounded-pill fw-medium text-capitalize">{{ $selectedCity }}</span>
			</div>
			<div class="col-auto">
				<span class="text-purple-700 bg-purple-100 badge rounded-pill fw-medium text-capitalize">{{ $selectedStateName }}</span>
			</div> --}}
			<div class="col-auto">
				<span class="text-purple-700 bg-purple-100 badge rounded-pill fw-medium text-capitalize">{{ $selectedCountry }}</span>
			</div>
		</div>
	</div>
</div>
