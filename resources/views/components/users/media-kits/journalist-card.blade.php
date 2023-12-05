<div class="col-12" :key="$mediaKit->id">
	<div class="card border-0 rounded-3 bg-white shadow">
		<div class="card-body">
			@php
				if (str()->contains($mediaKit->story_type, 'PressRelease')){
					$title = 'Press Release';
					$route = route('journalist.media-kit.press-release.view', ['mediaKit' => $mediaKit->slug]);
				}
				elseif (str()->contains($mediaKit->story_type, 'Article')){
					$title = 'Article';
					$route = route('journalist.media-kit.article.view', ['mediaKit' => $mediaKit->slug]);
				}
				elseif (str()->contains($mediaKit->story_type, 'Project')){
					$title = 'Project';
					$route = route('journalist.media-kit.project.view', ['mediaKit' => $mediaKit->slug]);
				}
			@endphp
			<div class="row">
				<div class="col-md-4">
					<img src="{{ Storage::url($mediaKit->story->cover_image_path) }}" class="img-square" alt="...">
				</div>
				<div class="col-md-8">
					<div class="row justify-content-center pb-2">
						<p class="text-secondary fs-6 fw-semibold col m-0">{{ $title }}</p>
						<p class="text-end text-secondary fs-6 fw-semibold col m-0">{{ $mediaKit->category->name }}</p>
					</div>
					<h5 class="card-title text-dark fs-5 fw-semibold m-0 py-2">{{ $mediaKit->story->title }}</h5>
					<div class="row align-items-center py-2">
						<div class="col">
							<p class="fs-6 fw-bold m-0">
								<a class="text-dark" href="{{ route('journalist.brand.view', ['brand' => $mediaKit->architect->company->slug]) }}">
									<img class="rounded-circle img-square img-30 me-2" src="{{ $mediaKit->architect->company->profileImage ? Storage::url($mediaKit->architect->company->profileImage->image_path) : 'https://via.placeholder.com/30x30' }}" alt="..." />
									{{ $mediaKit->architect->company->name }}
								</a>
							</p>
						</div>
					</div>
					<p class="card-text text-dark fs-6 m-0 py-2">{{ $mediaKit->story->concept_note }}</p>
					<div class="row justify-content-center pt-2 position-relative" style="z-index: 2;">
						<p class="fs-6 fw-bold col m-0">
							<a href="{{ $route }}" class="btn btn-primary btn-sm rounded-pill">
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
