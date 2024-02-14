<div class="row">
	<div class="col-lg-auto">
		<div class="filter-btn text-end pb-3">
			<button class="btn btn-primary rounded-0" data-bs-toggle="collapse" data-bs-target="#collapsedFilter" aria-expanded="false" aria-controls="collapsedFilter">
				<i class="bi bi-filter"></i>
			</button>
		</div>
		<div class="position-relative">
			<div class="filter-container p-0 rounded-3" id="collapsedFilter">
				<div class="card border-0 rounded-3 bg-white shadow">
					<div class="card-body">
						<form wire:submit="search">
							@include('users.includes.architect.media-kit-nav-types', ['type' => 'draft'])
							<div class="input-group mb-4">
								<label class="input-group-text bg-white" for="filterSearchInput"><i class="bi bi-search"></i></label>
								<input id="filterSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search by name" aria-label="Search" wire:model="name" />
							</div>
							<x-users.filter.header text="Media Kit Type" />
							<div class="d-grid mb-2">
								<button type="button" class="btn btn-light fw-semibold text-start" wire:click="selectAll('media-kit')">View all</button>
							</div>
							<x-users.filter.checkbox-list type="media-kit-type" :list="$mediaKitTypes" model="selectedMediaKitTypes" />
							<hr class="divider">
							<x-users.filter.header text="Categories" />
							<div class="d-grid mb-2">
								<button type="button" class="btn btn-light fw-semibold text-start" wire:click="selectAll('category')">View all</button>
							</div>
							<x-users.filter.checkbox-list type="category" :list="$categories" model="selectedCategories" />
							<hr class="divider">
							<div class="d-grid gap-2">
								<button type="submit" class="btn btn-white text-capitalize">
									search
									<x-users.spinners.primary-btn wire:target="search" />
								</button>
								<button type="button" class="btn btn-danger text-capitalize" wire:click="clear">
									clear
									<x-users.spinners.white-btn wire:target="clear" />
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg">
		@if($mediaKits->count() > 0)
			<div class="row g-4">
				@foreach ($mediaKits as $mediaKit)
					<div class="col-12" :key="$mediaKit->id">
						<div class="card border-0 rounded-3 bg-white shadow">
							<div class="card-body">
								@php
									$content = json_decode($mediaKit->content);
									// dd($content);
									if ($mediaKit->media_kit_type == 'press-release'){
										$mediaKitTitle = 'Press Release';
										$mediaKitHeading = $content->pressReleaseTitle;
										$mediaKitBody = $content->conceptNote;
										// $viewRoute = route('architect.media-kit.press-release.view', ['mediaKit' => $mediaKit->slug]);
										$editRoute = route('architect.add-story.press-release.draft', ['mediaKitDraft' => $mediaKit->id]);
									}
									elseif ($mediaKit->media_kit_type == 'article'){
										$mediaKitTitle = 'Article';
										$mediaKitHeading = $content->articleTitle;
										$mediaKitBody = $content->previewText;
										// $viewRoute = route('architect.media-kit.article.view', ['mediaKit' => $mediaKit->slug]);
										$editRoute = route('architect.add-story.article.draft', ['mediaKitDraft' => $mediaKit->id]);
									}
									elseif ($mediaKit->media_kit_type == 'project'){
										$mediaKitTitle = 'Project';
										$mediaKitHeading = $content->projectTitle;
										$mediaKitBody = $content->projectBrief;
										// $viewRoute = route('architect.media-kit.project.view', ['mediaKit' => $mediaKit->slug]);
										$editRoute = route('architect.add-story.project.draft', ['mediaKitDraft' => $mediaKit->id]);
									}
									$mediaKitHeading = str()->length($mediaKitHeading) < 150 ? $mediaKitHeading : str()->substr($mediaKitHeading, 0, 149) . '...';
									$mediaKitBody = str()->length($mediaKitBody) < 150 ? $mediaKitBody : str()->substr($mediaKitBody, 0, 149) . '...';
									// echo str()->length($mediaKitHeading);
								@endphp
								<div class="row justify-content-center g-4">
									<div class="col-md-4">
										<p class="text-secondary fs-6 fw-semibold col m-0">{{ $mediaKitTitle }}</p>
									</div>
									<div class="col-md-4">
										<h5 class="card-title fs-5 fw-semibold m-0 py-2 text-dark">{{ $mediaKitHeading }}</h5>
										<p class="card-text text-dark m-0 py-2 fs-7">{{ $mediaKitBody }}</p>
									</div>
									<div class="col-md-4">
										<p class="fs-6 fw-bold col m-0">
											<a href="{{ $editRoute }}" class="text-purple-600">
												Complete Story <i class="bi bi-arrow-up-right small"></i>
											</a>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
			{{ $mediaKits->links('vendor.livewire.custom-pagination') }}
		@else
			<div class="row">
				<div class="col-12">
					<div class="card border-0 rounded-3 bg-white shadow">
						<div class="card-body text-center">
							<h4 class="card-title text-purple-900 fs-5 fw-semibold m-0 py-3">No result found.</h4>
						</div>
					</div>
				</div>
			</div>
		@endif
		{{-- <x-users.media-kits.architect-list :mediaKits="$mediaKits" /> --}}
	</div>
</div>
