<div class="row g-4">
	<style>
		#body{
			background: var(--fublis-white) !important;
		}
	</style>
	<div class="col-md-8">
		@php
			$city = $mediaKit->story->location->city()->first();
			$state = $city->state;
			$country = $state->country;
		@endphp
		<h1 class="py-2 m-0 text-dark fs-1 fw-semibold">{{ str()->headline($mediaKit->story->title) }}</h1>
		<div class="py-3 row justify-content-center g-2">
			<div class="col-auto">
				<x-users.tag name="Project" />
			</div>
			@if($mediaKit->category)
				<div class="col-auto">
					<x-users.tag :name="$mediaKit->category->name" />
				</div>
			@endif
			<div class="col-auto">
				<x-users.tag :name="$country->name" />
			</div>
		</div>
		<div class="mb-4 row">
			<div class="col">
				<img src="{{ Storage::url($mediaKit->story->cover_image_path) }}" width="791" height="491" alt="" class="img-fluid" />
			</div>
		</div>
		<div class="mb-4 row">
			<div class="col text-dark fs-4 fw-semibold">
				{{ $mediaKit->story->project_brief }}
			</div>
		</div>
		<hr class="my-5 border border-2 border-dark">
		<div class="row">
			<div class="row g-4">
				@foreach ($mediaKit->story->photographs as $photograph)
					<div class="col-md-4">
						<img src="{{ Storage::url($photograph->image_path) }}" width="250" height="164" alt="" class="img-fluid" />
					</div>
				@endforeach
				@if(!empty($mediaKit->story->draftPhotographs))
					@foreach ($mediaKit->story->draftPhotographs as $photograph)
						<div class="col-md-4">
							<img src="{{ Storage::url($photograph) }}" width="250" height="164" alt="" class="img-fluid" />
						</div>
					@endforeach
				@endif
			</div>
		</div>
	</div>
	<div class="col-md-4">
		@include('users.includes.common.media-kit-submitted-by')
		<hr class="border-gray-300">
		<div class="row">
			<div class="col-12">
				<div class="pb-2 row g-2">
					<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-pin-map"></i></p></div>
					<div class="col">
						<p class="p-0 m-0 text-secondary fs-6">
							<span class="fw-bold">Location </span>
							<span class="text-capitalize">
								- {{ $mediaKit->story->location->name }}, {{ $state->name }}, {{ $country->name }}
							</span>
						</p>
					</div>
				</div>
				@if ($mediaKit->story->site_area > 0)
					<div class="pb-2 row g-2">
						<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-textarea"></i></p></div>
						<div class="col">
							<p class="p-0 m-0 text-secondary fs-6">
								<span class="fw-bold">Site Area </span>
								<span>- {{ $mediaKit->story->site_area }} {{ $mediaKit->story->siteAreaUnit->name ?? '' }}</span>
							</p>
						</div>
					</div>
				@endif
				@if ($mediaKit->story->built_up_area > 0)
					<div class="pb-2 row g-2">
						<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-textarea"></i></p></div>
						<div class="col">
							<p class="p-0 m-0 text-secondary fs-6">
								<span class="fw-bold">Built Up Area </span>
								<span>- {{ $mediaKit->story->built_up_area }} {{ $mediaKit->story->builtUpAreaUnit->name ? '' }}</span>
							</p>
						</div>
					</div>
				@endif
				{{-- <div class="pb-2 row g-2">
					<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-calendar4"></i></p></div>
					<div class="col">
						<p class="p-0 m-0 text-secondary fs-6">
							<span class="fw-bold">Year </span>
							<span>- 2021</span>
						</p>
					</div>
				</div> --}}
				@if ($mediaKit->story->buildingUse)
					@if ($mediaKit->story->buildingUse->buildingTypology)
					<div class="pb-2 row g-2">
						<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-building"></i></p></div>
						<div class="col">
							<p class="p-0 m-0 text-secondary fs-6">
								<span class="fw-bold">Typology </span>
								<span>- {{ $mediaKit->story->buildingUse->buildingTypology->name }}</span>
							</p>
						</div>
					</div>
					@endif
					<div class="pb-2 row g-2">
						<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-building"></i></p></div>
						<div class="col">
							<p class="p-0 m-0 text-secondary fs-6">
								<span class="fw-bold">Use </span>
								<span>- {{ $mediaKit->story->buildingUse->name }}</span>
							</p>
						</div>
					</div>
				@endif
				@if ($mediaKit->story->text_credits)
					<div class="pb-2 row g-2">
						<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-pencil"></i></p></div>
						<div class="col">
							<p class="p-0 m-0 text-secondary fs-6">
								<span class="fw-bold">Text Credits </span>
								<span>- {{ $mediaKit->story->text_credits }}</span>
							</p>
						</div>
					</div>
				@endif
				@if ($mediaKit->story->image_credits)
					<div class="pb-2 row g-2">
						<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-camera"></i></p></div>
						<div class="col">
							<p class="p-0 m-0 text-secondary fs-6">
								<span class="fw-bold">Photography Credits </span>
								<span>- {{ $mediaKit->story->image_credits }}</span>
							</p>
						</div>
					</div>
				@endif
				@if ($mediaKit->story->design_team)
					<div class="pb-2 row g-2">
						<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-people"></i></p></div>
						<div class="col">
							<p class="p-0 m-0 text-secondary fs-6">
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
		@include('users.includes.common.media-kit-audio-video-url')
		@include('users.includes.common.media-kit-media-contact')
		@include('users.includes.common.media-kit-tags')
	</div>
</div>
