<div class="row">
	<div class="col-lg-auto">
		<div class="pb-3 filter-btn text-end">
			<button class="btn btn-primary rounded-0" data-bs-toggle="collapse" data-bs-target="#collapsedFilter" aria-expanded="false" aria-controls="collapsedFilter">
				<i class="bi bi-filter"></i>
			</button>
		</div>
		<div class="position-relative">
			<div class="filter-container" id="collapsedFilter">
				<form wire:submit="search">
					@include('users.includes.architect.pitch-story-nav-types', ['type' => 'call'])
					<div class="mb-4 input-group">
						<label class="bg-white input-group-text" for="filterSearchInput"><i class="bi bi-search"></i></label>
						<input id="filterSearchInput" class="shadow-none form-control border-start-0 ps-0" type="search" placeholder="Search by name" aria-label="Search" wire:model="name" />
					</div>
					<x-users.filter.header text="Location" />
					<x-users.filter.select type="location" :list="$locations" model="selectedLocation" />
					<hr class="divider">
					<x-users.filter.header text="Deadline" />
					<input type="text" id="inputDeadline" class="form-control datepicker" wire:model="deadline">
					{{-- <input type="hidden" id="my_hidden_input"> --}}
					<hr class="divider">
					<x-users.filter.header text="Publication Types" />
					<div class="mb-2 d-grid">
						<button type="button" class="btn btn-light fw-semibold text-start" wire:click="selectAll('publication-type')">View all</button>
					</div>
					<x-users.filter.checkbox-list type="publication-type" :list="$publicationTypes" model="selectedPubliationTypes" />
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
	<div class="col-lg">
		@if($calls->count() > 0)
		<div class="row g-4">
			@foreach ($calls as $call)
			<div class="col-12" :key="$call->id">
				<div class="bg-white border-0 shadow card rounded-3">
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="pb-3 row align-items-center g-3">
									<div class="col-md-7">
										<div class="text-center row justify-content-center align-items-center text-md-start">
											<p class="m-0 col-12 fs-5 fw-semibold">
												<a href="{{ route('architect.pitch-story.calls.view', ['call' => $call->slug]) }}" class="text-dark">
													{{ $call->title }}
												</a>
											</p>
											<p class="m-0 col-12 text-secondary fs-6">Deadline: {{ formatDate($call->submission_end_date) }}</p>
										</div>
									</div>
									<div class="col-md-5">
										<div class="row justify-content-center align-items-end">
											<p class="m-0 text-center col text-md-end fs-6">
												<button type="button" class="btn btn-primary btn-sm fw-medium" wire:click="showMediaKit('{{ $call->id }}')">
													Submit Story <x-users.spinners.white-btn wire:target="showMediaKit('{{ $call->id }}')" />
												</button>
											</p>
										</div>
									</div>
								</div>
								<div class="row justify-content-center align-items-end g-3">
									<div class="col-md-6">
										<div class="row justify-content-end">
											<div class="col-12">
												<div class="row justify-content-center justify-content-md-start align-items-center">
													<div class="col-auto">
														@php
															$profileImg = $call->publication->profileImage ?
																			Storage::url($call->publication->profileImage->image_path) :
																			App\Http\Controllers\Users\AvatarController::setProfileAvatar([
																				'name' => $call->publication->name,
																				'width' => 45,
																				'fontSize' => 18,
																				'background' => $call->publication->background_color,
																				'foreground' => $call->publication->foreground_color,
																			], 'publication');
														@endphp
														<img src="{{ $profileImg }}" class="img-sqaure img-45 rounded-circle" alt="..." />
													</div>
													<div class="col-auto fs-6">
														<p class="p-0 m-0 fw-semibold">
															<a class="text-secondary" href="{{ route('architect.pitch-story.publications.view', ['publication' => $call->publication->slug]) }}">
																{{ $call->publication->name }}
															</a>
														</p>
														<p class="p-0 m-0 small">
															<a class="text-secondary" href="{{ route('architect.pitch-story.journalists.view', ['journalist' => $call->journalist->slug]) }}">
																{{ $call->journalist->user->name }}
															</a>
														</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="flex-wrap d-flex justify-content-center justify-content-md-end align-items-center fw-medium">
											<span class="mb-1 text-purple-700 badge rounded-pill bg-purple-50">
												{{ $call->language->name }}
											</span>
											<span class="mb-1 text-purple-700 badge rounded-pill bg-purple-50">Project</span>
											<span class="mb-1 text-purple-700 badge rounded-pill bg-purple-50">
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
				<div class="bg-white border-0 shadow card rounded-3">
					<div class="card-body">
						<h5 class="text-center text-purple-700 fs-5">No Result Found</h5>
					</div>
				</div>
			</div>
		</div>
		@endif
	</div>

	@include('users.includes.architect.pitch-story-modals')
</div>
