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
							@include('users.includes.architect.pitch-story-nav-types', ['type' => 'publication'])
							<div class="input-group mb-4">
								<label class="input-group-text bg-white" for="filterSearchInput"><i class="bi bi-search"></i></label>
								<input id="filterSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search by name" aria-label="Search" wire:model="name" />
							</div>
							<x-users.filter.header text="Location" />
							<x-users.filter.select type="location" :list="$locations" model="selectedLocation" />
							<hr class="divider">
							<x-users.filter.header text="Publication Types" />
							<div class="d-grid mb-2">
								<button type="button" class="btn btn-light fw-semibold text-start" wire:click="selectAll('publication-type')">View all</button>
							</div>
							<x-users.filter.checkbox-list type="publication-type" :list="$publicationTypes" model="selectedPubliationTypes" />
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
		<x-users.publications.full-list :publications="$publications" />
		{{-- @if($publications->count() > 0)
		<div class="row g-4">
			@foreach ($publications as $publication)
			<div class="col-12">
				<div class="card border-0 rounded-3 bg-white shadow">
					<div class="card-body">
						<div class="row gx-2 gy-4">
							<div class="col-sm-auto">
								<div class="d-block mx-auto text-center">
									<img src="{{ $publication->profileImage ? Storage::url($publication->profileImage->image_path) : 'https://via.placeholder.com/150x150' }}" class="img-square img-150" alt="...">
								</div>
							</div>
							<div class="col-sm">
								<div class="row align-items-center pb-4">
									<p class="fs-6 col m-0">
										<span class="badge rounded-pill text-bg-secondary mb-1">
											<i class="bi bi-geo-alt"></i>
											{{ $publication->location->name }}
										</span>
										@foreach ($publication->publicationTypes as $publicationType)
										<span class="badge rounded-pill text-bg-secondary mb-1">{{ $publicationType->name }}</span>
										@endforeach
										@if($publication->language)
										<span class="badge rounded-pill text-bg-secondary mb-1">
											{{ $publication->language->name }}
										</span>
										@endif
									</p>
									<p class="text-end fs-6 col m-0">
										<button type="button" class="btn btn-primary btn-sm fw-medium" wire:click="showContact('{{ $publication->id }}')">
											Pitch Story <x-users.spinners.white-btn wire:target="showContact('{{ $publication->id }}')" />
										</button>
									</p>
								</div>
								<div class="row justify-content-end align-items-end g-4">
									<div class="col">
										<div class="row justify-content-center">
											@if($publication->monthly_visitors)
											<div class="col-12">
												<p class="fw-medium m-0 py-2">
													<span class="badge rounded-pill bg-purple-50 text-purple-700">{{ $publication->monthly_visitors }} monthly visits</span>
												</p>
											</div>
											@endif
											<div class="col-12">
												<h5 class="fs-6 fw-semibold m-0 pt-3">
													<a href="{{ route('architect.pitch-story.publications.view', ['publication' => $publication->slug]) }}" class="text-dark">
														{{ $publication->name }}
													</a>
												</h5>
												<p class="fs-6 m-0 p-0">
													<a href="{{ $publication->website }}" class="text-secondary small" target="_blank">
														{{ trimWebsiteUrl($publication->website) }}
													</a>
												</p>
											</div>
										</div>
									</div>
									<div class="col-auto">
										<div class="d-flex justify-content-end align-items-center flex-wrap fw-medium">
											@foreach ($publication->categories as $category)
												<span class="badge rounded-pill bg-purple-50 text-purple-700">{{ $category->name }}</span>
											@endforeach
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		{{ $publications->links('vendor.livewire.custom-pagination') }}
		@else
		<div class="row">
			<div class="col-12">
				<div class="card border-0 rounded-3 bg-white shadow">
					<div class="card-body">
						<h5 class="fs-5 text-purple-700 text-center">No Result Found</h5>
					</div>
				</div>
			</div>
		</div>
		@endif --}}
	</div>

	@include('users.includes.architect.pitch-story-modals')
</div>
