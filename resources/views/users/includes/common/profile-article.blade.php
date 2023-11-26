<div class="row g-4">
	<div class="col-md-8">
		<h1 class="text-dark fs-2 fw-semibold m-0 py-2">{{ $mediaKit->story->title }}</h1>
		<div class="row justify-content-center g-2 py-3">
			<div class="col-auto">
				<span class="badge rounded-pill bg-purple-50 text-purple-700 fs-6 fw-medium">Article</span>
			</div>
			<div class="col-auto">
				<span class="badge rounded-pill bg-purple-50 text-purple-700 fs-6 fw-medium">{{ $mediaKit->category->name }}</span>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col text-secondary fs-6">
				{{ $mediaKit->story->article_writeup }}
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<img src="{{ Storage::url($mediaKit->story->cover_image_path) }}" style="max-width: 790px; max-height: 400px;" alt="" class="img-fluid" />
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
						<p class="text-purple-800 fs-6 fw-medium m-0 p-0">{{ $mediaKit->architect->company->name }}</p>
						<p class="fs-6 m-0 p-0">
							<a href="{{ $mediaKit->architect->company->website }}" class="text-secondary">{{ trimWebsiteUrl($mediaKit->architect->company->website) }}</a>
						</p>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="row g-2 justify-content-end">
					@if($allowedEdit)
					<div class="col-auto">
						<a href="{{ route('architect.media-kit.profile.edit', ['mediaKit' => $mediaKit->id]) }}" class="text-purple-600">
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
				<img src="{{ Storage::url($mediaKit->story->cover_image_path) }}" style="max-width: 401px; max-height: 213px;" class="img-fluid" alt="..." />
			</div>
		</div>
		<hr class="border-gray-300">
		<div class="row align-items-center">
			<div class="col">
				<p class="text-dark fs-6 m-0">Description</p>
			</div>
			<div class="col text-end">
				<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->article_doc_path ? Storage::download($mediaKit->story->article_doc_path) : $mediaKit->story->article_doc_link }}" target="_blank">Download</a>
			</div>
		</div>
		@if($mediaKit->story->images_link)
		<hr class="border-gray-300">
		<div class="row align-items-center">
			<div class="col">
				<p class="text-dark fs-6 m-0">Gallery</p>
			</div>
			<div class="col text-end">
				<button class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->images_link }}" target="_blank">Download</button>
			</div>
		</div>
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
						<p class="text-purple-800 fs-6 fw-medium m-0 p-0">{{ $mediaKit->architect->user->name }}</p>
						<p class="text-secondary fs-6 m-0 p-0">{{ $mediaKit->architect->position->name }}</p>
					</div>
					<div class="col-auto text-purple-700"><i class="bi bi-arrow-up-right"></i></div>
				</div>
			</div>
		</div>
	</div>
</div>
