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
							@include('users.includes.architect.pitch-story-nav-types', ['type' => 'publication'])
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
								</button> --}}
								<x-utility.buttons.search />
								<x-utility.buttons.clear />
								{{-- <button type="button" class="btn btn-danger text-capitalize" wire:click="clear">
									clear
									<x-users.spinners.white-btn wire:target="clear" />
								</button> --}}
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

	@include('users.includes.architect.pitch-story-modals')

	{{-- @script
		<script>
			let editor = document.querySelector("trix-editor");
			editor.editor.insertHTML('{!! addslashes($message) !!}');
		</script>
	@endscript --}}
</div>
