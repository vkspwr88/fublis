<div class="col-12" :key="$mediaKit->id">
	<div class="bg-white border-0 shadow card rounded-3">
		<div class="card-body">
			@php
				use App\Http\Controllers\Users\AvatarController as AvatarController;
				$studioProfileImg = $mediaKit->architect->company->profileImage ?
										Storage::url($mediaKit->architect->company->profileImage->image_path) :
										AvatarController::setProfileAvatar([
											'name' => $mediaKit->architect->company->name,
											'width' => 30,
											'fontSize' => 15,
											'background' => $mediaKit->architect->background_color,
											'foreground' => $mediaKit->architect->foreground_color,
										]);
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
					<div class="pb-2 row justify-content-center">
						<p class="m-0 text-secondary fs-6 fw-semibold col">{{ $mediaKitTitle }}</p>
						<p class="m-0 text-end text-secondary fs-6 fw-semibold col">{{ $mediaKit->category->name }}</p>
					</div>
					<h5 class="py-2 m-0 card-title fs-5 fw-semibold">
						<a href="{{ $viewRoute }}" class="text-dark">{{ $mediaKitHeading }}</a>
					</h5>
					<div class="py-2 row align-items-center">
						<div class="col">
							<p class="m-0 text-dark fs-6 fw-bold">
								<a class="text-dark" href="{{ route('architect.account.studio.index') }}">
									<img class="rounded-circle me-2 img-square img-30" src="{{ $studioProfileImg }}" alt="..." />
									{{ $mediaKit->architect->company->name }}
								</a>
							</p>
						</div>
					</div>
					<p class="py-2 m-0 card-text text-dark fs-7">{{ $mediaKitBody }}</p>
					<div class="pt-2 row justify-content-center position-relative" style="z-index: 2;">
						<p class="m-0 fs-6 fw-bold col">
							<a href="{{ $editRoute }}" class="text-purple-600">
								Edit Story <i class="bi bi-arrow-up-right small"></i>
							</a>
						</p>
						<p class="m-0 text-end fs-5 fw-bold col">
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
