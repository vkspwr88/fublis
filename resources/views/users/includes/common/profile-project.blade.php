<div class="row g-4">
	<div class="col-md-8">
		<h1 class="text-dark fs-2 fw-semibold m-0 py-2">{{ $mediaKit->story->title }}</h1>
		<div class="row justify-content-center g-2 py-3">
			<div class="col-auto">
				<x-users.tag name="Project" />
			</div>
			<div class="col-auto">
				<x-users.tag :name="$mediaKit->category->name" />
			</div>
			<div class="col-auto">
				<x-users.tag :name="$mediaKit->story->location->name" />
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
		@include('users.includes.common.media-kit-submitted-by')
		<hr class="border-gray-300">
		<div class="row">
			<div class="col-12">
				<div class="row g-2 pb-2">
					<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-pin-map"></i></p></div>
					<div class="col">
						<p class="m-0 p-0 text-secondary fs-6">
							<span class="fw-bold">Location </span>
							<span class="text-capitalize">
								- {{ $mediaKit->story->location->name }}, {{ $mediaKit->story->location->city()->first()->state->name }}, {{ $mediaKit->story->location->city()->first()->state->country->name }}
							</span>
						</p>
					</div>
				</div>
				@if ($mediaKit->story->site_area)
					<div class="row g-2 pb-2">
						<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-textarea"></i></p></div>
						<div class="col">
							<p class="m-0 p-0 text-secondary fs-6">
								<span class="fw-bold">Site Area </span>
								<span>- {{ $mediaKit->story->site_area }} {{ $mediaKit->story->siteAreaUnit->name }}</span>
							</p>
						</div>
					</div>
				@endif
				@if ($mediaKit->story->built_up_area)
					<div class="row g-2 pb-2">
						<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-textarea"></i></p></div>
						<div class="col">
							<p class="m-0 p-0 text-secondary fs-6">
								<span class="fw-bold">Built Up Area </span>
								<span>- {{ $mediaKit->story->built_up_area }} {{ $mediaKit->story->builtUpAreaUnit->name }}</span>
							</p>
						</div>
					</div>
				@endif
				{{-- <div class="row g-2 pb-2">
					<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-calendar4"></i></p></div>
					<div class="col">
						<p class="m-0 p-0 text-secondary fs-6">
							<span class="fw-bold">Year </span>
							<span>- 2021</span>
						</p>
					</div>
				</div> --}}
				@if ($mediaKit->story->buildingUse)
					@if ($mediaKit->story->buildingUse->buildingTypology)
					<div class="row g-2 pb-2">
						<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-building"></i></p></div>
						<div class="col">
							<p class="m-0 p-0 text-secondary fs-6">
								<span class="fw-bold">Typology </span>
								<span>- {{ $mediaKit->story->buildingUse->buildingTypology->name }}</span>
							</p>
						</div>
					</div>
					@endif
					<div class="row g-2 pb-2">
						<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-building"></i></p></div>
						<div class="col">
							<p class="m-0 p-0 text-secondary fs-6">
								<span class="fw-bold">Use </span>
								<span>- {{ $mediaKit->story->buildingUse->name }}</span>
							</p>
						</div>
					</div>
				@endif
				@if ($mediaKit->story->text_credits)
					<div class="row g-2 pb-2">
						<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-pencil"></i></p></div>
						<div class="col">
							<p class="m-0 p-0 text-secondary fs-6">
								<span class="fw-bold">Text Credits </span>
								<span>- {{ $mediaKit->story->text_credits }}</span>
							</p>
						</div>
					</div>
				@endif
				@if ($mediaKit->story->image_credits)
					<div class="row g-2 pb-2">
						<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-camera"></i></p></div>
						<div class="col">
							<p class="m-0 p-0 text-secondary fs-6">
								<span class="fw-bold">Photography Credits </span>
								<span>- {{ $mediaKit->story->image_credits }}</span>
							</p>
						</div>
					</div>
				@endif
				@if ($mediaKit->story->design_team)
					<div class="row g-2 pb-2">
						<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-people"></i></p></div>
						<div class="col">
							<p class="m-0 p-0 text-secondary fs-6">
								<span class="fw-bold">Design Team </span>
								<span>- {{ $mediaKit->story->design_team }}</span>
							</p>
						</div>
					</div>
				@endif
			</div>
		</div>
		<hr class="border-gray-300">
		@if ($viewAs == 'architect')
			@include('users.includes.common.profile-project-download-architect')
		@elseif ($viewAs == 'journalist')
			@include('users.includes.common.profile-project-download-journalist')
		@endif
		<hr class="border-gray-300">
		@include('users.includes.common.media-kit-media-contact')
		@include('users.includes.common.media-kit-tags')
	</div>
</div>
