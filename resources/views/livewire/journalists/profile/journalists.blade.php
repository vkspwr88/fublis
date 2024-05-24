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
							@include('users.includes.journalist.call-nav-types', ['type' => 'journalist'])
							<div class="mb-4 input-group">
								<label class="bg-white input-group-text" for="filterSearchInput"><i class="bi bi-search"></i></label>
								<input id="filterSearchInput" class="shadow-none form-control border-start-0 ps-0" type="search" placeholder="Search by name" aria-label="Search" wire:model="name" />
							</div>
							<x-users.filter.header text="Location" />
							<x-users.filter.select type="location" :list="$locations" model="selectedLocation" />
							<hr class="divider">
							<x-users.filter.header text="Publication Types" />
							<div class="mb-2 d-grid">
								<button type="button" class="btn btn-light fw-semibold text-start" wire:click="selectAll('publication-type')">View all</button>
							</div>
							<x-users.filter.checkbox-list type="publication-type" :list="$publicationTypes" model="selectedPubliationTypes" />
							<hr class="divider">
							<x-users.filter.header text="Role Types" />
							<div class="mb-2 d-grid">
								<button type="button" class="btn btn-light fw-semibold text-start" wire:click="selectAll('position')">View all</button>
							</div>
							<x-users.filter.checkbox-list type="role-type" :list="$positions" model="selectedPositions" />
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
		<x-users.journalists.full-list :journalists="$journalists" />
		{{-- @if($journalists->count() > 0)
		<div class="row g-4">
			@foreach ($journalists as $journalist)
			<div class="col-12">
				<div class="bg-white border-0 shadow card rounded-3">
					<div class="card-body">
						<div class="row gx-2 gy-4">
							<div class="col-sm-3">
								<div class="mx-auto text-center d-block">
									<img src="{{ $journalist->profileImage ? Storage::url($journalist->profileImage->image_path) : 'https://via.placeholder.com/150x150' }}" class="img-square img-150" alt="...">
								</div>
							</div>
							<div class="col-sm-9">
								<div class="pb-4 row align-items-center">
									<p class="m-0 fs-6 col">
										<span class="mb-1 badge rounded-pill text-bg-secondary">
											<i class="bi bi-geo-alt"></i>
											{{ $journalist->publications[0]->location->name }}
										</span>
										@foreach ($journalist->publications[0]->publicationTypes as $publicationType)
										<span class="mb-1 badge rounded-pill text-bg-secondary">{{ $publicationType->name }}</span>
										@endforeach
										@if($journalist->language)
										<span class="mb-1 badge rounded-pill text-bg-secondary">
											{{ $journalist->language->name }}
										</span>
										@endif
									</p>
								</div>
								<div class="pb-2 row justify-content-center">
									<div class="col">
										<h5 class="m-0 fs-5 fw-semibold">
											<a class="text-dark" href="{{ route('journalist.account.profile.journalists.view', ['journalist' => $journalist->slug]) }}">
												{{ $journalist->user->name }}
											</a>
										</h5>
										<p class="p-0 m-0 text-secondary fs-6"><span class="small">{{ $journalist->position->name }}</span></p>
									</div>
								</div>
								<div class="row align-items-center">
									<div class="col">
										<div class="row align-items-center g-2">
											<div class="col-auto">
												<img src="{{ $journalist->publications[0]->profileImage ? Storage::url($journalist->publications[0]->profileImage->image_path) : 'https://via.placeholder.com/30x30' }}" style="max-width: 30px; max-height: 30px;" class="img-fluid rounded-circle" alt="..." />
											</div>
											<div class="col">
												<p class="p-0 m-0 fs-6 fw-bold">
													<a class="text-dark" href="{{ route('journalist.account.profile.publications.view', ['publication' => $journalist->publications[0]->slug]) }}">
														<span class="small">{{ $journalist->publications[0]->name }}</span>
													</a>
												</p>
											</div>
										</div>
									</div>
									<div class="col-auto">
										<div class="flex-wrap d-flex justify-content-end align-items-center fw-medium">
											@foreach ($journalist->publications[0]->categories as $category)
												<span class="text-purple-700 badge rounded-pill bg-purple-50">{{ $category->name }}</span>
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
		{{ $journalists->links('vendor.livewire.custom-pagination') }}
		@else
		<div class="row">
			<div class="col-12">
				<div class="bg-white border-0 shadow card rounded-3">
					<div class="card-body">
						<h5 class="text-center text-purple-700 fs-5">No Result Found</h5>
					</div>
				</div>
			</div>
		</div>
		@endif --}}
	</div>
</div>
