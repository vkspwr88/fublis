<div class="border-0 shadow card rounded-3">
	<div class="bg-white card-header rounded-top-3">
		<table class="table p-0 m-0">
			<tr>
				<th class="border-0">
					<div class="input-group">
						<label class="bg-white input-group-text" for="filterSearchInput"><i class="bi bi-search"></i></label>
						<input id="filterSearchInput" class="shadow-none form-control border-start-0 ps-0" type="search" placeholder="Search Media Kit" aria-label="Search" />
					</div>
				</th>
			</tr>
		</table>
	</div>
	<div class="card-body">
		<table class="table">
			<tr>
				<th class="text-secondary fs-7">Project Name</th>
				<th class="text-secondary fs-7">Views</th>
				<th class="text-secondary fs-7">Downloads</th>
				<th class="text-secondary fs-7">Track Story</th>
			</tr>
			@forelse ($mediaKits as $mediaKit)
			<tr>
				<td class="py-4">
					<div class="row align-items-center g-1">
						<div class="col-auto">
							<img class="rounded-circle img-square img-32" src="{{ Storage::url($mediaKit->story->cover_image_path) }}" alt="..." />
						</div>
						<div class="col">
							<h6 class="p-0 m-0 text-dark fs-7 fw-medium">{{ $mediaKit->story->title }}</h6>
							<p class="p-0 m-0 text-secondary fs-8">{{ showModelName($mediaKit->story_type) }}</p>
						</div>
					</div>
				</td>
				<td class="py-4">
					<span class="btn btn-outline-success btn-sm">{{ $mediaKit->view_count }}</span>
				</td>
				<td class="py-4">
					<span class="btn btn-outline-success btn-sm">{{ $mediaKit->download_count }}</span>
				</td>
				<td class="py-4">
					<a href="{{ getMediaKitViewUrl( showModelName($mediaKit->story_type), $mediaKit->slug ) }}" class="btn btn-primary btn-sm">Track</a>
				</td>
			</tr>
			@empty
			<tr>
				<th colspan="4">
					<h4 class="text-center text-purple-800 fs-5">No Media Kit Added</h4>
				</th>
			</tr>
			@endforelse
		</table>
	</div>
</div>
