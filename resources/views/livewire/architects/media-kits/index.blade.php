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
							@include('users.includes.architect.media-kit-nav-types', ['type' => 'published'])
							<div class="mb-4 input-group">
								<label class="bg-white input-group-text" for="filterSearchInput"><i class="bi bi-search"></i></label>
								<input id="filterSearchInput" class="shadow-none form-control border-start-0 ps-0" type="search" placeholder="Search by name" aria-label="Search" wire:model="name" />
							</div>
							<x-users.filter.header text="Media Kit Type" />
							<div class="mb-2 d-grid">
								<button type="button" class="btn btn-light fw-semibold text-start" wire:click="selectAll('media-kit')">View all</button>
							</div>
							<x-users.filter.checkbox-list type="media-kit-type" :list="$mediaKitTypes" model="selectedMediaKitTypes" />
							<hr class="divider">
							<x-users.filter.header text="Categories" />
							<div class="mb-2 d-grid">
								<button type="button" class="btn btn-light fw-semibold text-start" wire:click="selectAll('category')">View all</button>
							</div>
							<x-users.filter.checkbox-list type="category" :list="$categories" model="selectedCategories" />
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
		<x-users.media-kits.architect-list :mediaKits="$ownMediaKits" />
	</div>

	@include('users.includes.architect.pitch-story-modals')
</div>
