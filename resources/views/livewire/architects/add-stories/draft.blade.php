<div class="row">
	<div class="col-lg-auto">
		<div class="pb-3 filter-btn text-end">
			<button class="btn btn-primary rounded-0" data-bs-toggle="collapse" data-bs-target="#collapsedFilter" aria-expanded="false" aria-controls="collapsedFilter">
				<i class="bi bi-filter"></i>
			</button>
		</div>
		<div class="position-relative">
			<div class="p-0 filter-container rounded-3" id="collapsedFilter">
				<div class="bg-white border-0 shadow card rounded-3">
					<div class="card-body">
						<form wire:submit="search">
							@include('users.includes.architect.media-kit-nav-types', ['type' => 'draft'])
							<div class="mb-4 input-group">
								<label class="bg-white input-group-text" for="filterSearchInput"><i class="bi bi-search"></i></label>
								<input id="filterSearchInput" class="shadow-none form-control border-start-0 ps-0" type="search" placeholder="Search by name" aria-label="Search" wire:model="name" />
							</div>
							<x-users.filter.header text="Media Kit Type" />
							<div class="mb-2 d-grid">
								<button type="button" class="btn btn-light fw-semibold text-start" wire:click="selectAll('media-kit')">View all</button>
							</div>
							<x-users.filter.checkbox-list type="media-kit-type" :list="$mediaKitTypes" model="selectedMediaKitTypes" />
							<hr class="divider">
							<x-users.filter.header text="Categories" />
							<div class="mb-2 d-grid">
								<button type="button" class="btn btn-light fw-semibold text-start" wire:click="selectAll('category')">View all</button>
							</div>
							<x-users.filter.checkbox-list type="category" :list="$categories" model="selectedCategories" />
							<hr class="divider">
							<div class="gap-2 d-grid">
								{{-- <button type="submit" class="btn btn-white text-capitalize">
									search
									<x-users.spinners.primary-btn wire:target="search" />
								</button>
								<button type="button" class="btn btn-danger text-capitalize" wire:click="clear">
									clear
									<x-users.spinners.white-btn wire:target="clear" />
								</button> --}}
								<x-utility.buttons.search />
								<x-utility.buttons.clear />
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
						<div class="bg-white border-0 shadow card rounded-3">
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
									$coverImage = $content->coverImage ? Storage::url($content->coverImage) : 'https://via.placeholder.com/150x150';
									// echo str()->length($mediaKitHeading);
								@endphp
								<div class="row justify-content-center g-4">
									<div class="col-md-4">
										<img src="{{ $coverImage }}" class="img-square" alt="...">
									</div>
									<div class="col-md-4">
										<p class="m-0 text-secondary fs-6 fw-semibold col">{{ $mediaKitTitle }}</p>
										<h5 class="py-2 m-0 card-title fs-5 fw-semibold text-dark">{{ $mediaKitHeading }}</h5>
										<p class="py-2 m-0 card-text text-dark fs-7">{{ $mediaKitBody }}</p>
									</div>
									<div class="col-md-4">
										<p class="m-0 fs-6 fw-bold col">
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
					<div class="bg-white border-0 shadow card rounded-3">
						<div class="text-center card-body">
							<h4 class="py-3 m-0 text-purple-900 card-title fs-5 fw-semibold">No result found.</h4>
						</div>
					</div>
				</div>
			</div>
		@endif
		{{-- <x-users.media-kits.architect-list :mediaKits="$mediaKits" /> --}}
	</div>
</div>
