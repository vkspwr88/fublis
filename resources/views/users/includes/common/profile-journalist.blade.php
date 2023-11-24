<div class="row g-3">
	<div class="col-md-5 col-lg-3">
		<div class="row g-3">
			<div class="col-12">
				<img src="{{ $journalist->profileImage ? Storage::url($journalist->profileImage->image_path) : 'https://via.placeholder.com/150x150' }}" class="img-square img-150" alt="logo">
			</div>
			<div class="col-12">
				<h4 class="text-dark fs-5 fw-semibold m-0 p-0">{{ $journalist->user->name }}</h4>
				<p class="m-0 p-0">{{ $journalist->position->name }}</p>
			</div>
			<div class="col-12">
				<div class="d-grid">
					@if($viewAs == 'architect')
					<button type="button" class="btn btn-primary fw-medium" wire:click="test">
						Submit Story <x-users.spinners.white-btn wire:target="test" />
					</button>
					@elseif ($viewAs == 'journalist')
					<a href="{{ route('journalist.account.profile.setting.personal-info') }}" class="btn btn-primary fw-medium">Edit Profile</a>
					@endif
				</div>
			</div>
			<div class="col-12">
				<div class="row g-2">
					<div class="col-auto">
						<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-geo-alt text-secondary" viewBox="0 0 16 16">
							<path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
							<path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
						</svg>
					</div>
					<div class="col">
						<span class="badge rounded-pill text-gray-700 bg-gray-200">{{ $journalist->location->name ?? '-' }}</span>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="row g-2">
					<div class="col-auto">
						<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-translate text-secondary" viewBox="0 0 16 16">
							<path d="M4.545 6.714 4.11 8H3l1.862-5h1.284L8 8H6.833l-.435-1.286H4.545zm1.634-.736L5.5 3.956h-.049l-.679 2.022H6.18z"/>
							<path d="M0 2a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v3h3a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-3H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2zm7.138 9.995c.193.301.402.583.63.846-.748.575-1.673 1.001-2.768 1.292.178.217.451.635.555.867 1.125-.359 2.08-.844 2.886-1.494.777.665 1.739 1.165 2.93 1.472.133-.254.414-.673.629-.89-1.125-.253-2.057-.694-2.82-1.284.681-.747 1.222-1.651 1.621-2.757H14V8h-3v1.047h.765c-.318.844-.74 1.546-1.272 2.13a6.066 6.066 0 0 1-.415-.492 1.988 1.988 0 0 1-.94.31z"/>
						</svg>
					</div>
					<div class="col">
						<span class="badge rounded-pill text-gray-700 bg-gray-200">{{ $journalist->language->name ?? '-' }}</span>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="row g-2">
					<div class="col-auto">
						<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-tag text-secondary" style="margin-top: 5px;" viewBox="0 0 16 16">
							<path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0z"/>
							<path d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1zm0 5.586 7 7L13.586 9l-7-7H2v4.586z"/>
						</svg>
					</div>
					<div class="col">
						@foreach ($categories as $category)
						<span class="badge rounded-pill text-purple-700 bg-purple-100 mb-1">{{ $category->name }}</span>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="row g-3">
			<div class="col-12">
				<h6 class="text-dark fs-6 fw-semibold">Associated Publications</h6>
			</div>
			@foreach ($journalist->associatedPublications as $publication)
			<div class="col-12">
				<div class="row g-1 align-items-center">
					<div class="col-auto">
						<img src="{{ $publication->profileImage ? Storage::url($publication->profileImage->image_path) : 'https://via.placeholder.com/48x48' }}" style="max-width: 48px; max-height: 48px;" alt=".." class="img-fluid rounded-circle">
					</div>
					<div class="col">
						<h6 class="text-purple-800 fw-medium m-0 p-0">{{ $publication->name }}</h6>
						<p class="text-secondary m-0 p-0"><a href="{{ $publication->website }}" class="text-secondary" target="_blank">{{ trimWebsiteUrl($publication->website) }}</a></p>
					</div>
					<div class="col-auto">
						<a href="{{ route('architect.pitch-story.publications.view', ['publication' => $publication->id]) }}" class="btn btn-primary fw-medium p-2">
							<i class="bi bi-send-fill"></i>
						</a>
					</div>
				</div>
			</div>
			@endforeach
			@if ($viewAs == 'journalist')
			<div class="col-12">
				<div class="d-grid">
					<a href="{{ route('journalist.account.profile.setting.publication') }}" class="btn btn-primary fw-medium">Add Publication</a>
				</div>
			</div>
			@endif
		</div>
	</div>
	<div class="col-md-7 col-lg-9">
		@if ($viewAs == 'architect')
			<livewire:architects.journalist-posts :journalist="$journalist" />
		@elseif ($viewAs == 'journalist')
			<livewire:journalists.profile.posts :journalist="$journalist" />
		@endif
	</div>
</div>
