<h2 class="m-0 py-2 text-secondary fs-3 fw-semibold text-capitalize">{{ $title }}</h2>
<p class="m-0 py-2 text-secondary">
	<span class="fw-medium"><i>submitted by</i></span>
	<span class="fw-bold">
		@if(isArchitect())
			<a href="{{ route('architect.pitch-story.journalists.view', ['journalist' => $call->journalist->slug]) }}" class="text-purple-700">{{ $submittedBy }}</a>
		@elseif (isJournalist())
			<a href="{{ route('journalist.account.profile.journalists.view', ['journalist' => $journalistSlug ?? $call->journalist->slug]) }}" class="text-purple-700">{{ $submittedBy }}</a>
		@endif
	</span>
</p>
<hr class="border-gray-300 my-3">
<div class="row g-4">
	<div class="col-md-4">
		<p class="text-secondary fw-semibold m-0 p-0">Call for Submissions</p>
	</div>
	<div class="col-md-8">{{ $description }}</div>
</div>
<hr class="border-gray-300 my-3">
<div class="row g-4">
	<div class="col-md-4">
		<p class="text-secondary fw-semibold m-0 p-0">Submission Deadline</p>
	</div>
	<div class="col-md-8">{{ formatDate($submissionEndsDate) }}</div>
</div>
<hr class="border-gray-300 my-3">
<div class="row g-4">
	<div class="col-md-4">
		<p class="text-secondary fw-semibold m-0 p-0">Publication</p>
	</div>
	<div class="col-md-8">
		<div class="row align-items-center">
			<div class="col-auto">
				<img class="rounded-circle img-square img-45" src="{{ $publication->profileImage ? Storage::url($publication->profileImage->image_path) : 'https://via.placeholder.com/45x45' }}" alt=".." />
			</div>
			<div class="col">
				<p class="fw-semibold m-0 p-0">
					@if(isArchitect())
						<a href="{{ route('architect.pitch-story.publications.view', ['publication' => $publication->slug]) }}" class="text-secondary">{{ $publication->name }}</a>
					@elseif (isJournalist())
						<a href="{{ route('journalist.account.profile.publications.view', ['publication' => $publication->slug]) }}" class="text-secondary">{{ $publication->name }}</a>
					@endif
				</p>
				<p class="m-0 p-0">
					<span class="small">
						<a href="{{ $publication->website }}" target="_blank" class="text-secondary">{{ trimWebsiteUrl($publication->website) }}</a>
					</span></p>
			</div>
		</div>
	</div>
</div>
<hr class="border-gray-300 my-3">
<div class="row g-4">
	<div class="col-md-4">
		<p class="text-secondary fw-semibold m-0 p-0">Entries Invited</p>
	</div>
	<div class="col-md-8">
		<div class="row justify-content-start gx-1 gy-3">
			<div class="col-auto">
				<span class="badge rounded-pill bg-purple-100 text-purple-700 fw-medium">{{ $publishFrom->name }}</span>
			</div>
		</div>
	</div>
</div>
<hr class="border-gray-300 my-3">
<div class="row g-4">
	<div class="col-md-4">
		<p class="text-secondary fw-semibold m-0 p-0">Tags</p>
	</div>
	<div class="col-md-8">
		<div class="row justify-content-start gx-1 gy-3">
			<div class="col-auto">
				<span class="badge rounded-pill bg-purple-100 text-purple-700 fw-medium">{{ $category->name }}</span>
			</div>
			<div class="col-auto">
				<span class="badge rounded-pill bg-purple-100 text-purple-700 fw-medium">{{ $language->name }}</span>
			</div>
			<div class="col-auto">
				<span class="badge rounded-pill bg-purple-100 text-purple-700 fw-medium text-capitalize">{{ $selectedCity }}</span>
			</div>
			<div class="col-auto">
				<span class="badge rounded-pill bg-purple-100 text-purple-700 fw-medium text-capitalize">{{ $selectedStateName }}</span>
			</div>
			<div class="col-auto">
				<span class="badge rounded-pill bg-purple-100 text-purple-700 fw-medium text-capitalize">{{ $selectedCountryName }}</span>
			</div>
		</div>
	</div>
</div>
