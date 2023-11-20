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
							<div class="row g-0 mb-4">
								<div class="col">
									<div class="d-grid">
										<input type="radio" class="btn-check btn-filter-check" name="options-outlined" id="published-outlined" autocomplete="off" checked>
										<label class="btn btn-outline-primary rounded-0 fw-semibold" for="published-outlined">Published</label>
									</div>
								</div>
								<div class="col">
									<div class="d-grid">
										<input type="radio" class="btn-check btn-filter-check" name="options-outlined" id="drafts-outlined" autocomplete="off">
										<label class="btn btn-outline-primary rounded-0 fw-semibold" for="drafts-outlined">Drafts</label>
									</div>
								</div>
							</div>
							<div class="input-group mb-4">
								<label class="input-group-text bg-white" for="filterSearchInput"><i class="bi bi-search"></i></label>
								<input id="filterSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search by name" aria-label="Search" wire:model="name" />
							</div>
							<x-users.filter.header text="Media Kit Type" />
							<div class="d-grid mb-2">
								<button type="button" class="btn btn-light fw-semibold text-start" wire:click="selectAll('media-kit')">View all</button>
							</div>
							<x-users.filter.checkbox-list type="media-kit-type" :list="$mediaKitTypes" model="selectedMediaKitTypes" />
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
		<x-users.media-kits.architect-list :mediaKits="$mediaKits" />
	</div>
</div>
