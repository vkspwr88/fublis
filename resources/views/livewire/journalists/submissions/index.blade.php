<div class="row">
	<div class="col-lg-4">
		<div class="filter-btn text-end pb-3">
			<button class="btn btn-primary rounded-0" data-bs-toggle="collapse" data-bs-target="#collapsedFilter" aria-expanded="false" aria-controls="collapsedFilter">
				<i class="bi bi-filter"></i>
			</button>
		</div>
		<div class="position-relative">
			<div class="filter-container" id="collapsedFilter">
				<div class="card border-0 rounded-3 bg-white shadow">
					<div class="card-body">
						<form wire:submit="searchCall">
							@include('users.includes.journalist.media-kit-nav-types', ['type' => 'submission'])
							<div class="input-group mb-4">
								<label class="input-group-text bg-white" for="filterSearchInput">
									<i class="bi bi-search"></i>
								</label>
								<input id="filterSearchInput" class="form-control border-start-0 border-end-0 shadow-none ps-0" type="search" placeholder="Search by name" aria-label="Search" wire:model="name" wire:keyup.debounce="searchCall" />
								<label class="input-group-text bg-white">
									<x-users.spinners.primary-btn wire:target="searchCall" />
								</label>
							</div>
							<div class="row g-2">
							@forelse ($calls as $call)
								<div class="col-12" wire:key="{{ $call->id }}">
									<input type="radio" id="call-{{ $call->id }}" value="{{ $call->id }}" wire:model="selectedCall" class="position-absolute opacity-0 list-radio" wire:change="getMediaKits('{{ $call->id }}')">
									<div class="px-3 py-2 rounded-3">
										<label for="call-{{ $call->id }}" class="fw-semibold fs-6 d-block">
											{{ $call->title }}
											<x-users.spinners.primary-btn wire:target="getMediaKits('{{ $call->id }}')" />
										</label>
									</div>
								</div>
							@empty
								<div class="col-12">
									<h5 class="text-center">No Calls</h5>
								</div>
							@endforelse
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-8">
		<x-users.media-kits.journalist-list :mediaKits="$mediaKits" />
	</div>
</div>
