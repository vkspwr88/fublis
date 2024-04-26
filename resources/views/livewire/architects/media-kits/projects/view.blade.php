<div class="col-12">
	<div class="bg-white border-0 shadow card rounded-3">
		<div class="card-body">
			<a href="{{ route('architect.media-kit.project.view', ['mediaKit' => $project->id]) }}" class="stretched-link"></a>
			<div class="row">
				<div class="col-md-4">
					<img src="{{ Storage::url($project->story->cover_image_path) }}" class="img-fluid" style="max-width: 300px; max-height: 300px;" alt="...">
				</div>
				<div class="col-md-8">
					<div class="pb-2 row justify-content-center">
						<p class="m-0 text-secondary fs-6 fw-semibold col">Project</p>
						<p class="m-0 text-end text-secondary fs-6 fw-semibold col">{{ $project->category->name }}</p>
					</div>
					<h5 class="py-2 m-0 card-title text-dark fs-5 fw-semibold">{{ $project->story->title }}</h5>
					<div class="py-2 row align-items-center">
						<div class="col">
							<p class="m-0 text-dark fs-6 fw-bold">
								@php
									$profileImg = $project->architect->company->profileImage ?
														Storage::url($project->architect->company->profileImage->image_path) :
														App\Http\Controllers\Users\AvatarController::setProfileAvatar([
															'name' => $project->architect->company->name,
															'width' => 30,
															'fontSize' => 13,
															'background' => $project->architect->company->background_color,
															'foreground' => $project->architect->company->foreground_color,
														]);
								@endphp
								<img class="img-square img-30 rounded-circle me-2" src="{{ $profileImg }}" alt="..." />
								{{ $project->architect->company->name }}
							</p>
						</div>
					</div>
					<p class="py-2 m-0 card-text text-dark fs-6">{!! nl2br(e($project->story->project_brief)) !!}</p>
					<div class="pt-2 row justify-content-center position-relative" style="z-index: 2;">
						<p class="m-0 fs-6 fw-bold col">
							<a href="{{ route('architect.media-kit.project.edit', ['mediaKit' => $project->id]) }}" class="text-purple-600">
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
