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
							@include('users.includes.journalist.call-nav-types', ['type' => 'journalist'])
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
							<x-users.filter.header text="Role Types" />
							<div class="d-grid mb-2">
								<button type="button" class="btn btn-light fw-semibold text-start" wire:click="selectAll('position')">View all</button>
							</div>
							<x-users.filter.checkbox-list type="role-type" :list="$positions" model="selectedPositions" />
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
		@if($journalists->count() > 0)
		<div class="row g-4">
			@foreach ($journalists as $journalist)
			<div class="col-12">
				<div class="card border-0 rounded-3 bg-white shadow">
					<div class="card-body">
						<div class="row gx-2 gy-4">
							<div class="col-sm-3">
								<div class="d-block mx-auto text-center">
									<img src="{{ $journalist->profileImage ? Storage::url($journalist->profileImage->image_path) : 'https://via.placeholder.com/150x150' }}" class="img-square img-150" alt="...">
								</div>
							</div>
							<div class="col-sm-9">
								<div class="row align-items-center pb-4">
									<p class="fs-6 col m-0">
										<span class="badge rounded-pill text-bg-secondary mb-1">
											<i class="bi bi-geo-alt"></i>
											{{ $journalist->publications[0]->location->name }}
										</span>
										@foreach ($journalist->publications[0]->publicationTypes as $publicationType)
										<span class="badge rounded-pill text-bg-secondary mb-1">{{ $publicationType->name }}</span>
										@endforeach
										@if($journalist->language)
										<span class="badge rounded-pill text-bg-secondary mb-1">
											{{ $journalist->language->name }}
										</span>
										@endif
									</p>
									{{-- <p class="text-end fs-6 col m-0">
										<button type="button" class="btn btn-primary btn-sm fw-medium" wire:click="pitchJournalist('{{ $journalist->id }}')">
											Submit Story <x-users.spinners.white-btn wire:target="pitchJournalist('{{ $journalist->id }}')" />
										</button>
									</p> --}}
								</div>
								<div class="row justify-content-center pb-2">
									<div class="col">
										<h5 class="fs-5 fw-semibold m-0">
											<a class="text-dark" href="{{ route('journalist.account.profile.journalists.view', ['journalist' => $journalist->slug]) }}">
												{{ $journalist->user->name }}
											</a>
										</h5>
										<p class="text-secondary fs-6 m-0 p-0"><span class="small">{{ $journalist->position->name }}</span></p>
									</div>
								</div>
								<div class="row align-items-center">
									<div class="col">
										<div class="row align-items-center g-2">
											<div class="col-auto">
												<img src="{{ $journalist->publications[0]->profileImage ? Storage::url($journalist->publications[0]->profileImage->image_path) : 'https://via.placeholder.com/30x30' }}" style="max-width: 30px; max-height: 30px;" class="img-fluid rounded-circle" alt="..." />
											</div>
											<div class="col">
												<p class="fs-6 m-0 p-0 fw-bold">
													<a class="text-dark" href="{{ route('journalist.account.profile.publications.view', ['publication' => $journalist->publications[0]->slug]) }}">
														<span class="small">{{ $journalist->publications[0]->name }}</span>
													</a>
												</p>
											</div>
										</div>
									</div>
									<div class="col-auto">
										<div class="d-flex justify-content-end align-items-center flex-wrap fw-medium">
											@foreach ($journalist->publications[0]->categories as $category)
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
		{{ $journalists->links('vendor.livewire.custom-pagination') }}
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
		@endif
	</div>
</div>
