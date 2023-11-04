<div class="col-12" :key="$mediaKit->id">
	<div class="card border-0 rounded-3 bg-white shadow">
		<div class="card-body">
			@php
				if (str()->contains($mediaKit->story_type, 'PressRelease')){
					$title = 'Press Release';
					$viewRoute = route('architect.media-kit.press-release.view', ['mediaKit' => $mediaKit->id]);
					$editRoute = route('architect.media-kit.press-release.edit', ['mediaKit' => $mediaKit->id]);
				}
				elseif (str()->contains($mediaKit->story_type, 'Article')){
					$title = 'Article';
					$viewRoute = route('architect.media-kit.article.view', ['mediaKit' => $mediaKit->id]);
					$editRoute = route('architect.media-kit.article.edit', ['mediaKit' => $mediaKit->id]);
				}
				elseif (str()->contains($mediaKit->story_type, 'Project')){
					$title = 'Project';
					$viewRoute = route('architect.media-kit.project.view', ['mediaKit' => $mediaKit->id]);
					$editRoute = route('architect.media-kit.project.edit', ['mediaKit' => $mediaKit->id]);
				}
			@endphp
			<div class="row g-4">
				<div class="col-md-4">
					<img src="{{ Storage::url($mediaKit->story->cover_image_path) }}" class="img-fluid" style="max-width: 300px; max-height: 300px;" alt="...">
				</div>
				<div class="col-md-8">
					<div class="row justify-content-center pb-2">
						<p class="text-secondary fs-6 fw-semibold col m-0">{{ $title }}</p>
						<p class="text-end text-secondary fs-6 fw-semibold col m-0">{{ $mediaKit->category->name }}</p>
					</div>
					<h5 class="card-title fs-5 fw-semibold m-0 py-2">
						<a href="{{ $viewRoute }}" class="text-dark">{{ $mediaKit->story->title }}</a>
					</h5>
					<div class="row align-items-center py-2">
						<div class="col">
							<p class="text-dark fs-6 fw-bold m-0">
								<img class="img-fluid rounded-circle me-2" src="{{ $mediaKit->architect->company->profileImage ? Storage::url($mediaKit->architect->company->profileImage) : 'https://via.placeholder.com/30x30' }}" style="max-width: 30px; max-height: 30px;" alt="..." />
								{{ $mediaKit->architect->company->name }}
							</p>
						</div>
					</div>
					<p class="card-text text-dark fs-6 m-0 py-2">{{ $mediaKit->story->concept_note }}</p>
					<div class="row justify-content-center pt-2 position-relative" style="z-index: 2;">
						<p class="fs-6 fw-bold col m-0">
							<a href="{{ $editRoute }}" class="text-purple-600">
								Edit Story <i class="bi bi-arrow-up-right small"></i>
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
