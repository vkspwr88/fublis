<div class="col-12" :key="$mediaKit->id">
	<div class="bg-white border-0 shadow card rounded-3">
		<div class="card-body">
			@php
				$studioProfileImg = $mediaKit->architect->company->profileImage ?
									Storage::url($mediaKit->architect->company->profileImage->image_path) :
									App\Http\Controllers\Users\AvatarController::setProfileAvatar([
										'name' => $mediaKit->architect->company->name,
										'width' => 150,
										'fontSize' => 60,
										'background' => $mediaKit->architect->company->background_color,
										'foreground' => $mediaKit->architect->company->foreground_color,
									]);
				if (str()->contains($mediaKit->story_type, 'PressRelease')){
					$mediaKitTitle = 'Press Release';
					$mediaKitHeading = $mediaKit->story->title;
					$mediaKitBody = $mediaKit->story->concept_note;
					$route = route('journalist.media-kit.press-release.view', ['mediaKit' => $mediaKit->slug]);
				}
				elseif (str()->contains($mediaKit->story_type, 'Article')){
					$mediaKitTitle = 'Article';
					$mediaKitHeading = $mediaKit->story->title;
					$mediaKitBody = $mediaKit->story->preview_text;
					$route = route('journalist.media-kit.article.view', ['mediaKit' => $mediaKit->slug]);
				}
				elseif (str()->contains($mediaKit->story_type, 'Project')){
					$mediaKitTitle = 'Project';
					$mediaKitHeading = $mediaKit->story->title;
					$mediaKitBody = $mediaKit->story->project_brief;
					$route = route('journalist.media-kit.project.view', ['mediaKit' => $mediaKit->slug]);
				}
				$mediaKitHeading = str()->length($mediaKitHeading) < 150 ? $mediaKitHeading : str()->substr($mediaKitHeading, 0, 149) . '...';
				$mediaKitBody = str()->length($mediaKitBody) < 150 ? $mediaKitBody : str()->substr($mediaKitBody, 0, 149) . '...';
			@endphp
			<div class="row">
				<div class="col-md-4">
					<img src="{{ Storage::url($mediaKit->story->cover_image_path) }}" class="img-square" alt="...">
				</div>
				<div class="col-md-8">
					<div class="pb-2 row justify-content-center">
						<p class="m-0 text-secondary fs-6 fw-semibold col">{{ $mediaKitTitle }}</p>
						<p class="m-0 text-end text-secondary fs-6 fw-semibold col">{{ $mediaKit->category->name ?? '' }}</p>
					</div>
					<h5 class="py-2 m-0 card-title text-dark fs-5 fw-semibold">{{ $mediaKitHeading }}</h5>
					<div class="py-2 row align-items-center">
						<div class="col">
							<p class="m-0 fs-6 fw-bold">
								<a class="text-dark" href="{{ route('journalist.brand.view', ['brand' => $mediaKit->architect->company->slug]) }}">
									<img class="rounded-circle img-square img-30 me-2" src="{{ $studioProfileImg }}" alt="..." />
									{{ $mediaKit->architect->company->name }}
								</a>
							</p>
						</div>
					</div>
					<p class="py-2 m-0 card-text text-dark fs-7">{{ $mediaKitBody }}</p>
					<div class="pt-2 row justify-content-center position-relative" style="z-index: 2;">
						<p class="m-0 fs-6 fw-bold col">
							<a href="{{ $route }}" class="btn btn-primary btn-sm rounded-pill">
								View Media Kit <i class="bi bi-arrow-up-right small"></i>
							</a>
						</p>
						{{-- <p class="m-0 text-end fs-5 fw-bold col">
							<a href="#" class="text-purple-600">
								<i class="bi bi-share-fill"></i>
							</a>
						</p> --}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
