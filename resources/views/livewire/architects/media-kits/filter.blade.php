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
		<input id="filterSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search by name" aria-label="Search" />
	</div>
	<x-users.filter.header text="Media Kit Type" />
	<x-users.filter.checkbox-list type="media-kit-type" :list="$mediaKitTypes" model="selectedMediaKitType" />
	<hr class="divider">
	<x-users.filter.header text="Categories" />
	<x-users.filter.checkbox-list type="category" :list="$categories" model="selectedCategories" />
	<hr class="divider">
	<div class="d-grid">
		<button type="submit" class="btn btn-white text-capitalize">search</button>
	</div>
</form>
