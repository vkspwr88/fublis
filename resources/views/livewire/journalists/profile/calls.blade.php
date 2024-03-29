<div class="row">
	<div class="col-lg-auto">
		<div class="filter-btn text-end pb-3">
			<button class="btn btn-primary rounded-0" data-bs-toggle="collapse" data-bs-target="#collapsedFilter" aria-expanded="false" aria-controls="collapsedFilter">
				<i class="bi bi-filter"></i>
			</button>
		</div>
		<div class="position-relative">
			<div class="filter-container" id="collapsedFilter">
				<form wire:submit="search">
					@include('users.includes.journalist.call-nav-types', ['type' => 'call'])
					<div class="input-group mb-4">
						<label class="input-group-text bg-white" for="filterSearchInput"><i class="bi bi-search"></i></label>
						<input id="filterSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search by name" aria-label="Search" wire:model="name" />
					</div>
					<x-users.filter.header text="Location" />
					<x-users.filter.select type="location" :list="$locations" model="selectedLocation" />
					<hr class="divider">
					<x-users.filter.header text="Deadline" />
					<input type="text" id="inputDeadline" class="form-control datepicker" wire:model="deadline">
					{{-- <input type="hidden" id="my_hidden_input"> --}}
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
	<div class="col-lg">
		@if($calls->count() > 0)
		<div class="row g-4">
			@foreach ($calls as $call)
			<div class="col-12">
				<div class="card border-0 rounded-3 bg-white shadow">
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="row align-items-center pb-3 g-3">
									<div class="col-md-7">
										<div class="row justify-content-center align-items-center text-center text-md-start">
											<p class="col-12 fs-5 fw-semibold m-0">
												<a href="{{ route('journalist.call.view', ['call' => $call->slug]) }}" class="text-dark">
													{{ $call->title }}
												</a>
											</p>
											<p class="col-12 text-secondary fs-6 m-0">Deadline: {{ formatDate($call->submission_end_date) }}</p>
										</div>
									</div>
									{{-- <div class="col-md-5">
										<div class="row justify-content-center align-items-end">
											<p class="col text-center text-md-end fs-6 m-0">
												<button type="button" class="btn btn-primary btn-sm fw-medium" wire:click="showMediaKit('{{ $call->id }}')">
													Submit Story <x-users.spinners.white-btn wire:target="showMediaKit('{{ $call->id }}')" />
												</button>
											</p>
										</div>
									</div> --}}
								</div>
								<div class="row justify-content-center align-items-end g-3">
									<div class="col-md-6">
										<div class="row justify-content-end">
											<div class="col-12">
												<div class="row justify-content-center justify-content-md-start align-items-center">
													<div class="col-auto">
														<img src="{{ $call->publication->profileImage ? Storage::url($call->publication->profileImage->image_path) : 'https://via.placeholder.com/45x45' }}" class="img-sqaure img-45 rounded-circle" alt="..." />
													</div>
													<div class="col-auto fs-6">
														<p class="fw-semibold m-0 p-0">
															<a class="text-secondary" href="{{ route('journalist.account.profile.publications.view', ['publication' => $call->publication->slug]) }}">
																{{ $call->publication->name }}
															</a>
														</p>
														<p class="m-0 p-0 small">
															<a class="text-secondary" href="{{ route('journalist.account.profile.journalists.view', ['journalist' => $call->journalist->slug]) }}">
																{{ $call->journalist->user->name }}
															</a>
														</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="d-flex justify-content-center justify-content-md-end align-items-center flex-wrap fw-medium">
											<span class="badge rounded-pill bg-purple-50 text-purple-700 mb-1">
												{{ $call->language->name }}
											</span>
											<span class="badge rounded-pill bg-purple-50 text-purple-700 mb-1">Project</span>
											<span class="badge rounded-pill bg-purple-50 text-purple-700 mb-1">
												{{ $call->category->name }}
											</span>
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
		{{ $calls->links('vendor.livewire.custom-pagination') }}
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
