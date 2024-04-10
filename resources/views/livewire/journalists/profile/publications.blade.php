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
							@include('users.includes.journalist.call-nav-types', ['type' => 'publication'])
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
	</div>
</div>
