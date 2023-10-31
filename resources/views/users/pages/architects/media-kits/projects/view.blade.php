@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container py-5">
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
					<img src="{{ Storage::url($mediaKit->story->cover_image_path) }}" style="max-width: 791px; max-height: 491px;" alt="" class="img-fluid" />
				</div>
			</div>
			<div class="row">
				<div class="row g-4">
					@foreach ($mediaKit->story->photographs as $photograph)
					<div class="col-md-4">
						<img src="{{ Storage::url($photograph->image_path) }}" style="max-width: 250px; max-height: 164px;" alt="" class="img-fluid" />
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
							<img class="rounded-circle" src="https://via.placeholder.com/48x48" alt="..." />
						</div>
						<div class="col">
							<p class="text-purple-800 fs-6 fw-medium m-0 p-0">{{ $mediaKit->architect->company->name }}</p>
							<p class="fs-6 m-0 p-0">
								<a href="{{ $mediaKit->architect->company->website }}" class="text-secondary">{{ trimWebsiteUrl($mediaKit->architect->company->website) }}</a>
							</p>
						</div>
					</div>
				</div>
				<div class="col-4">
					<div class="row g-2 justify-content-end">
						<div class="col-auto">
							<a href="{{ route('architect.media-kit.project.edit', ['mediaKit' => $mediaKit->id]) }}" class="text-purple-600">
								<i class="bi bi-pencil-square"></i>
							</a>
						</div>
						<div class="col-auto">
							<a href="{{ route('architect.media-kit.project.edit', ['mediaKit' => $mediaKit->id]) }}" class="text-purple-600">
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
			<div class="row align-items-center">
				<div class="col">
					<p class="text-dark fs-6 m-0">Description</p>
				</div>
				<div class="col text-end">
					<a class="btn btn-primary fs-6 fw-medium" href="{{ Storage::download($mediaKit->story->project_doc_path) }}" target="_blank">Download</a>
				</div>
			</div>
			<hr class="border-gray-300">
			<div class="row align-items-center">
				<div class="col">
					<p class="text-dark fs-6 m-0">Gallery</p>
				</div>
				<div class="col text-end">
					<a class="btn btn-primary fs-6 fw-medium" href="{{ Storage::download($mediaKit->story->project_doc_path) }}" target="_blank">Download</a>
				</div>
			</div>
			<hr class="border-gray-300">
			<div class="row">
				<div class="col-12">
					<p class="text-dark fs-6 m-0 pb-2">Media Contact</p>
					<div class="row g-3 align-items-center">
						<div class="col-auto">
							<img class="rounded-circle" src="https://via.placeholder.com/48x48" alt="..." />
						</div>
						<div class="col-auto">
							<p class="text-purple-800 fs-6 fw-medium m-0 p-0">{{ $mediaKit->architect->user->name }}</p>
							<p class="text-secondary fs-6 m-0 p-0">{{ $mediaKit->architect->position->name }}</p>
						</div>
						<div class="col-auto text-purple-700"><i class="bi bi-arrow-up-right"></i></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
