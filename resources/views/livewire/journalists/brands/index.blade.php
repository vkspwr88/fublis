<div class="row">
	<div class="col-lg-auto">
		<div class="filter-btn text-end pb-3">
			<button class="btn btn-primary rounded-0" data-bs-toggle="collapse" data-bs-target="#collapsedFilter" aria-expanded="false" aria-controls="collapsedFilter">
				<i class="bi bi-filter"></i>
			</button>
		</div>
		<div class="position-relative">
			<div class="filter-container" id="collapsedFilter">
				<div class="card border-0 rounded-3 bg-white shadow">
					<div class="card-body">
						<form wire:submit="search">
							@include('users.includes.journalist.media-kit-nav-types', ['type' => 'brand'])
							<div class="input-group mb-4">
								<label class="input-group-text bg-white" for="filterSearchInput"><i class="bi bi-search"></i></label>
								<input id="filterSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search by name" aria-label="Search" wire:model="name" />
							</div>
							<x-users.filter.header text="Location" />
							<x-users.filter.select type="location" :list="$locations" model="selectedLocation" />
							<hr class="divider">
							<x-users.filter.header text="Categories" />
							<div class="d-grid mb-2">
								<button type="button" class="btn btn-light fw-semibold text-start" wire:click="selectAll('category')">View all</button>
							</div>
							<x-users.filter.checkbox-list type="category" :list="$categories" model="selectedCategories" />
							{{-- <x-users.filter.header text="Project Types" />
							<x-users.filter.checkbox-list type="category" :list="$projectTypes" model="selectedProjectTypes" /> --}}
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
		@if($brands->count() > 0)
		<div class="row g-4">
			@foreach ($brands as $brand)
			<div class="col-12">
				<div class="card border-0 rounded-3 bg-white shadow">
					<div class="card-body">
						<div class="row gx-2 gy-4">
							<div class="col-sm-3">
								<div class="d-block mx-auto text-center">
									<img src="{{ ($brand->profileImage != null) ? Storage::url($brand->profileImage->image_path) : 'https://via.placeholder.com/150x150' }}" class="img-square img-150" alt="{{ $brand->name }} logo">
								</div>
							</div>
							<div class="col-sm-9">
								<div class="row align-items-center">
									<p class="fs-6 col m-0">
										<span class="badge rounded-pill text-dark bg-light mb-1">
											<i class="bi bi-geo-alt"></i>
											{{ $brand->location->name }}
										</span>
										<span class="badge rounded-pill text-dark bg-light mb-1">
											{{ $brand->category->name }}
										</span>
									</p>
									<p class="text-end fs-6 col m-0">
										<a href="{{ route('journalist.brand.view', ['brand' => $brand->slug]) }}" class="btn btn-primary btn-sm rounded-pill">
											View Media Kits <i class="bi bi-arrow-up-right small"></i>
										</a>
									</p>
								</div>
								<div class="row g-2">
									<div class="col-12">
										<h5 class="fs-5 fw-semibold m-0 pt-3">
											<a href="{{ route('journalist.brand.view', ['brand' => $brand->slug]) }}" class="text-dark">{{ $brand->name }}</a>
										</h5>
										<p class="fs-6 m-0 p-0">
											<a href="{{ $brand->website }}" class="text-secondary small" target="_blank">{{ trimWebsiteUrl($brand->website) }}</a>
										</p>
									</div>
									<div class="col-12">
										<p class="m-0 p-0"><small>The House of Things Launches IRA Udaipur - A new luxury product lifestyle product label that celebrates the arts of Rajasthan & the romance of erstwhile Mewar</small></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
			{{ $brands->links('vendor.livewire.custom-pagination') }}
		</div>
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

	</div>
</div>
