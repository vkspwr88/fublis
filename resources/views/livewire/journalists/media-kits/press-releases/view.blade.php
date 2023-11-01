<div class="col-12">
	<div class="card border-0 rounded-3 bg-white shadow">
		<div class="card-body">
			{{-- <a href="{{ route('architect.media-kit.press-release.view', ['mediaKit' => $pressRelease->id]) }}" class="stretched-link"></a> --}}
			<div class="row">
				<div class="col-md-4">
					<img src="{{ Storage::url($pressRelease->story->cover_image_path) }}" class="img-fluid" style="max-width: 300px; max-height: 300px;" alt="...">
				</div>
				<div class="col-md-8">
					<div class="row justify-content-center pb-2">
						<p class="text-secondary fs-6 fw-semibold col m-0">Press Release</p>
						<p class="text-end text-secondary fs-6 fw-semibold col m-0">{{ $pressRelease->category->name }}</p>
					</div>
					<h5 class="card-title text-dark fs-5 fw-semibold m-0 py-2">{{ $pressRelease->story->title }}</h5>
					<div class="row align-items-center py-2">
						<div class="col">
							<p class="text-dark fs-6 fw-bold m-0">
								<img class="img-fluid rounded-circle me-2" src="https://via.placeholder.com/30x30" alt="..." />
								{{ $pressRelease->architect->company->name }}
							</p>
						</div>
					</div>
					<p class="card-text text-dark fs-6 m-0 py-2">{{ $pressRelease->story->concept_note }}</p>
					<div class="row justify-content-center pt-2 position-relative" style="z-index: 2;">
						<p class="fs-6 fw-bold col m-0">
							<a href="{{ route('journalist.media-kit.press-release.view', ['mediaKit' => $pressRelease->id]) }}" class="btn btn-primary btn-sm rounded-pill">
								View Media Kit <i class="bi bi-arrow-up-right small"></i>
							</a>
						</p>
						<p class="text-end fs-5 fw-bold col m-0">
							<a href="#" class="text-purple-600">
								<i class="bi bi-share-fill"></i>
							</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
