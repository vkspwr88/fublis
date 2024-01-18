<div class="row g-4">
	<div class="col-md-8">
		<h1 class="text-dark fs-2 fw-semibold m-0 py-2">{{ $mediaKit->story->title }}</h1>
		<div class="row justify-content-center g-2 py-3">
			<div class="col-auto">
				<span class="badge rounded-pill bg-purple-50 text-purple-700 fs-6 fw-medium">Project</span>
			</div>
			<div class="col-auto">
				<span class="badge rounded-pill bg-purple-50 text-purple-700 fs-6 fw-medium">{{ $mediaKit->category->name }}</span>
			</div>
			<div class="col-auto">
				<span class="badge rounded-pill bg-purple-50 text-purple-700 fs-6 fw-medium">{{ $mediaKit->story->location->name }}</span>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col">
				<img src="{{ Storage::url($mediaKit->story->cover_image_path) }}" width="791" height="491" alt="" class="img-fluid" />
			</div>
		</div>
		<div class="row">
			<div class="row g-4">
				@foreach ($mediaKit->story->photographs as $photograph)
				<div class="col-md-4">
					<img src="{{ Storage::url($photograph->image_path) }}" width="250" height="164" alt="" class="img-fluid" />
				</div>
				@endforeach
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<p class="text-dark fs-6 py-2">Submitted By</p>
		<div class="row align-items-center">
			<div class="col-8">
				<div class="row g-2">
					<div class="col-auto">
						<img class="rounded-circle img-square img-48" src="{{ $mediaKit->architect->company->profileImage ? Storage::url($mediaKit->architect->company->profileImage->image_path) : 'https://via.placeholder.com/48x48' }}" alt="..." />
					</div>
					<div class="col">
						<p class="fs-6 fw-medium m-0 p-0">
							@if ($viewAs == 'architect')
							<a class="text-purple-800" href="{{ route('architect.account.studio.index') }}">
								{{ $mediaKit->architect->company->name }}
							</a>
							@elseif ($viewAs == 'journalist')
							<a class="text-purple-800" href="{{ route('journalist.brand.view', ['brand' => $mediaKit->architect->company->slug]) }}">
								{{ $mediaKit->architect->company->name }}
							</a>
							@endif
						</p>
						<p class="fs-6 m-0 p-0">
							<a href="{{ $mediaKit->architect->company->website }}" class="text-secondary" target="_blank">{{ trimWebsiteUrl($mediaKit->architect->company->website) }}</a>
						</p>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="row g-2 justify-content-end">
					@if($allowedEdit)
					<div class="col-auto">
						<a href="{{ route('architect.media-kit.press-release.edit', ['mediaKit' => $mediaKit->slug]) }}" class="text-purple-600">
							<i class="bi bi-pencil-square"></i>
						</a>
					</div>
					@endif
					<div class="col-auto">
						<a href="javascript:;" class="text-purple-600">
							<i class="bi bi-share-fill"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<hr class="border-gray-300">
		<div class="row">
			<div class="col-12">
				<div class="row g-2 pb-2">
					<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-pin-map"></i></p></div>
					<div class="col">
						<p class="m-0 p-0 text-secondary fs-6">
							<span class="fw-bold">Location </span>
							<span>- {{ $mediaKit->story->location->name }}</span>
						</p>
					</div>
				</div>
				<div class="row g-2 pb-2">
					<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-textarea"></i></p></div>
					<div class="col">
						<p class="m-0 p-0 text-secondary fs-6">
							<span class="fw-bold">Area </span>
							<span>- {{ $mediaKit->story->site_area }} {{ $mediaKit->story->siteAreaUnit->name }}</span>
						</p>
					</div>
				</div>
				<div class="row g-2 pb-2">
					<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-calendar4"></i></p></div>
					<div class="col">
						<p class="m-0 p-0 text-secondary fs-6">
							<span class="fw-bold">Year </span>
							<span>- 2021</span>
						</p>
					</div>
				</div>
				<div class="row g-2 pb-2">
					<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-building"></i></p></div>
					<div class="col">
						<p class="m-0 p-0 text-secondary fs-6">
							<span class="fw-bold">Typology </span>
							<span>- {{ $mediaKit->story->buildingTypology->name }}</span>
						</p>
					</div>
				</div>
				<div class="row g-2 pb-2">
					<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-pencil"></i></p></div>
					<div class="col">
						<p class="m-0 p-0 text-secondary fs-6">
							<span class="fw-bold">Text Credits </span>
							<span>- {{ $mediaKit->story->text_credits }}</span>
						</p>
					</div>
				</div>
				<div class="row g-2 pb-2">
					<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-camera"></i></p></div>
					<div class="col">
						<p class="m-0 p-0 text-secondary fs-6">
							<span class="fw-bold">Photography Credits </span>
							<span>- {{ $mediaKit->story->image_credits }}</span>
						</p>
					</div>
				</div>
				<div class="row g-2 pb-2">
					<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-people"></i></p></div>
					<div class="col">
						<p class="m-0 p-0 text-secondary fs-6">
							<span class="fw-bold">Design Team </span>
							<span>- {{ $mediaKit->story->design_team }}</span>
						</p>
					</div>
				</div>
			</div>
		</div>
		<hr class="border-gray-300">
		@if ($viewAs == 'architect')
			@include('users.includes.common.profile-project-download-architect')
		@elseif ($viewAs == 'journalist')
			@include('users.includes.common.profile-project-download-journalist')
		@endif
		<hr class="border-gray-300">
		<div class="row">
			<div class="col-12">
				<p class="text-dark fs-6 m-0 pb-2">Media Contact</p>
				<div class="row g-3 align-items-center">
					<div class="col-auto">
						<img class="rounded-circle img-square img-48" src="{{ $mediaKit->architect->profileImage ? Storage::url($mediaKit->architect->profileImage->image_path) : 'https://via.placeholder.com/48x48' }}" alt="..." />
					</div>
					<div class="col-auto">
						<p class="fs-6 fw-medium m-0 p-0">
							@if ($viewAs == 'architect')
							<a class="text-purple-800" href="{{ route('architect.account.profile.index') }}">
								{{ $mediaKit->story->mediaContact->user->name }}
							</a>
							@elseif ($viewAs == 'journalist')
							<a class="text-purple-800" href="{{ route('journalist.brand.architect', ['architect' => $mediaKit->story->mediaContact->user->architect->slug]) }}">
								{{ $mediaKit->story->mediaContact->user->name }}
							</a>
							@endif
						</p>
						<p class="text-secondary fs-6 m-0 p-0">{{ $mediaKit->architect->position->name }}</p>
					</div>
					<div class="col-auto text-purple-700"><i class="bi bi-arrow-up-right"></i></div>
				</div>
			</div>
		</div>
		@if($mediaKit->story->tags->count())
			<hr class="border-gray-300">
			<div class="row">
				<div class="col-12">
					<p class="text-dark fs-6 m-0 pb-2">Tags</p>
					<div class="row justify-content-center g-2 py-3">
						@foreach ($mediaKit->story->tags as $tag)
							<div class="col-auto">
								<x-users.tag :name="$tag" />
							</div>
						@endforeach
					</div>
				</div>
			</div>
		@endif
	</div>
</div>
