<div class="col-12" :key="$mediaKit->id">
	<div class="card border-0 rounded-3 bg-white shadow">
		<div class="card-body">
			@php
				if (str()->contains($mediaKit->story_type, 'PressRelease')){
					$mediaKitTitle = 'Press Release';
					$mediaKitHeading = $mediaKit->story->title;
					$mediaKitBody = $mediaKit->story->concept_note;
					$viewRoute = route('architect.media-kit.press-release.view', ['mediaKit' => $mediaKit->slug]);
					$editRoute = route('architect.media-kit.press-release.edit', ['mediaKit' => $mediaKit->slug]);
				}
				elseif (str()->contains($mediaKit->story_type, 'Article')){
					$mediaKitTitle = 'Article';
					$mediaKitHeading = $mediaKit->story->title;
					$mediaKitBody = $mediaKit->story->preview_text;
					$viewRoute = route('architect.media-kit.article.view', ['mediaKit' => $mediaKit->slug]);
					$editRoute = route('architect.media-kit.article.edit', ['mediaKit' => $mediaKit->slug]);
				}
				elseif (str()->contains($mediaKit->story_type, 'Project')){
					$mediaKitTitle = 'Project';
					$mediaKitHeading = $mediaKit->story->title;
					$mediaKitBody = $mediaKit->story->project_brief;
					$viewRoute = route('architect.media-kit.project.view', ['mediaKit' => $mediaKit->slug]);
					$editRoute = route('architect.media-kit.project.edit', ['mediaKit' => $mediaKit->slug]);
				}
				$mediaKitHeading = str()->length($mediaKitHeading) < 150 ? $mediaKitHeading : str()->substr($mediaKitHeading, 0, 149) . '...';
				$mediaKitBody = str()->length($mediaKitBody) < 150 ? $mediaKitBody : str()->substr($mediaKitBody, 0, 149) . '...';
				// echo str()->length($mediaKitHeading);
			@endphp
			<div class="row g-4">
				<div class="col-md-4">
					<img src="{{ Storage::url($mediaKit->story->cover_image_path) }}" class="img-square" alt="...">
				</div>
				<div class="col-md-8">
					<div class="row justify-content-center pb-2">
						<p class="text-secondary fs-6 fw-semibold col m-0">{{ $mediaKitTitle }}</p>
						<p class="text-end text-secondary fs-6 fw-semibold col m-0">{{ $mediaKit->category->name }}</p>
					</div>
					<h5 class="card-title fs-5 fw-semibold m-0 py-2">
						<a href="{{ $viewRoute }}" class="text-dark">{{ $mediaKitHeading }}</a>
					</h5>
					<div class="row align-items-center py-2">
						<div class="col">
							<p class="text-dark fs-6 fw-bold m-0">
								<a class="text-dark" href="{{ route('architect.account.studio.index') }}">
									<img class="rounded-circle me-2 img-square img-30" src="{{ $mediaKit->architect->company->profileImage ? Storage::url($mediaKit->architect->company->profileImage->image_path) : 'https://via.placeholder.com/30x30' }}" alt="..." />
									{{ $mediaKit->architect->company->name }}
								</a>
							</p>
						</div>
					</div>
					<p class="card-text text-dark m-0 py-2 fs-7">{{ $mediaKitBody }}</p>
					<div class="row justify-content-center pt-2 position-relative" style="z-index: 2;">
						<p class="fs-6 fw-bold col m-0">
							<a href="{{ $editRoute }}" class="text-purple-600">
								Edit Story <i class="bi bi-arrow-up-right small"></i>
							</a>
						</p>
						<p class="text-end fs-5 fw-bold col m-0">
							<button type="button" class="btn btn-primary fs-6 fw-medium">
								Pitch
							</button>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
