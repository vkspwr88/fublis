<div class="row">
	<div class="col-lg-auto">
		<div class="pb-3 filter-btn text-end">
			<button class="btn btn-primary rounded-0" data-bs-toggle="collapse" data-bs-target="#collapsedFilter" aria-expanded="false" aria-controls="collapsedFilter">
				<i class="bi bi-filter"></i>
			</button>
		</div>
		<div class="position-relative">
			<div class="filter-container" id="collapsedFilter">
				<div class="bg-white border-0 shadow card rounded-3">
					<div class="card-body">
						<form wire:submit="search">
							@include('users.includes.journalist.media-kit-nav-types', ['type' => 'brand'])
							<div class="mb-4 input-group">
								<label class="bg-white input-group-text" for="filterSearchInput"><i class="bi bi-search"></i></label>
								<input id="filterSearchInput" class="shadow-none form-control border-start-0 ps-0" type="search" placeholder="Search by name" aria-label="Search" wire:model="name" />
							</div>
							<x-users.filter.header text="Location" />
							<x-users.filter.select type="location" :list="$locations" model="selectedLocation" />
							<hr class="divider">
							<x-users.filter.header text="Categories" />
							<div class="mb-2 d-grid">
								<button type="button" class="btn btn-light fw-semibold text-start" wire:click="selectAll('category')">View all</button>
							</div>
							<x-users.filter.checkbox-list type="category" :list="$categories" model="selectedCategories" />
							{{-- <x-users.filter.header text="Project Types" />
							<x-users.filter.checkbox-list type="category" :list="$projectTypes" model="selectedProjectTypes" /> --}}
							<hr class="divider">
							<div class="gap-2 d-grid">
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
				<div class="bg-white border-0 shadow card rounded-3">
					<div class="card-body">
						<div class="row gx-2 gy-4">
							<div class="col-sm-3">
								<div class="mx-auto text-center d-block">
									@php
										$studioProfileImg = $brand->profileImage ?
															Storage::url($brand->profileImage->image_path) :
															App\Http\Controllers\Users\AvatarController::setProfileAvatar([
																'name' => $brand->name,
																'width' => 150,
																'fontSize' => 60,
																'background' => $brand->background_color,
																'foreground' => $brand->foreground_color,
															]);
									@endphp
									<img src="{{ $studioProfileImg }}" class="img-square img-150" alt="{{ $brand->name }} logo">
								</div>
							</div>
							<div class="col-sm-9">
								<div class="row align-items-center">
									<p class="m-0 fs-6 col">
										<span class="mb-1 badge rounded-pill text-dark bg-light">
											<i class="bi bi-geo-alt"></i>
											{{ $brand->location->name }}
										</span>
										<span class="mb-1 badge rounded-pill text-dark bg-light">
											{{ $brand->category->name }}
										</span>
									</p>
									<p class="m-0 text-end fs-6 col">
										<a href="{{ route('journalist.brand.view', ['brand' => $brand->slug]) }}" class="btn btn-primary btn-sm rounded-pill">
											View Media Kits <i class="bi bi-arrow-up-right small"></i>
										</a>
									</p>
								</div>
								<div class="row g-2">
									<div class="col-12">
										<h5 class="pt-3 m-0 fs-5 fw-semibold">
											<a href="{{ route('journalist.brand.view', ['brand' => $brand->slug]) }}" class="text-dark">{{ $brand->name }}</a>
										</h5>
										<p class="p-0 m-0 fs-6">
											<a href="{{ $brand->website }}" class="text-secondary small" target="_blank">{{ trimWebsiteUrl($brand->website) }}</a>
										</p>
									</div>
									<div class="col-12">
										<p class="p-0 m-0"><small>The House of Things Launches IRA Udaipur - A new luxury product lifestyle product label that celebrates the arts of Rajasthan & the romance of erstwhile Mewar</small></p>
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
				<div class="bg-white border-0 shadow card rounded-3">
					<div class="text-center card-body">
						<h4 class="py-3 m-0 text-purple-900 card-title fs-5 fw-semibold">No result found.</h4>
					</div>
				</div>
			</div>
		</div>
		@endif

	</div>
</div>
