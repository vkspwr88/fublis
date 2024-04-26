<div class="col-12">
	<div class="bg-white border-0 shadow card rounded-3">
		<div class="card-body">
			<a href="{{ route('architect.media-kit.article.view', ['mediaKit' => $article->id]) }}" class="stretched-link"></a>
			<div class="row">
				<div class="col-sm-4">
					<img src="{{ Storage::url($article->story->cover_image_path) }}" class="img-fluid" style="max-width: 300px; max-height: 300px;" alt="...">
				</div>
				<div class="col-sm-8">
					<div class="pb-2 row justify-content-center">
						<p class="m-0 text-secondary fs-6 fw-semibold col">Article</p>
						<p class="m-0 text-end text-secondary fs-6 fw-semibold col">{{ $article->category->name }}</p>
					</div>
					<h5 class="py-2 m-0 card-title text-dark fs-5 fw-semibold">{{ $article->story->title }}</h5>
					<div class="py-2 row align-items-center">
						<div class="col">
							<p class="m-0 text-dark fs-6 fw-bold">
								@php
									$profileImg = $article->architect->company->profileImage ?
														Storage::url($article->architect->company->profileImage->image_path) :
														App\Http\Controllers\Users\AvatarController::setProfileAvatar([
															'name' => $article->architect->company->name,
															'width' => 30,
															'fontSize' => 13,
															'background' => $article->architect->company->background_color,
															'foreground' => $article->architect->company->foreground_color,
														]);
								@endphp
								<img class="img-square img-30 rounded-circle me-2" src="{{ $profileImg }}" alt="..." />
								{{ $article->architect->company->name }}
							</p>
						</div>
					</div>
					<p class="py-2 m-0 card-text text-dark fs-6">{!! nl2br(e($article->story->preview_text)) !!}</p>
					<div class="pt-2 row justify-content-center position-relative" style="z-index: 2;">
						<p class="m-0 fs-6 fw-bold col">
							<a href="{{ route('architect.media-kit.article.edit', ['mediaKit' => $article->id]) }}" class="text-purple-600">
								Edit Story <i class="bi bi-arrow-up-right small"></i>
							</a>
						</p>
						<p class="m-0 text-end fs-5 fw-bold col">
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
