<form wire:submit="search">
    <div class="input-group mb-4">
		<label class="input-group-text bg-white" for="blogSearchInput"><i class="bi bi-search"></i></label>
		<input id="blogSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search by name" aria-label="Search">
	</div>
	<x-users.filter.header text="choose category" />
	<x-users.filter.checkbox-list type="category" :list="$categories" model="selectedCategories" />
	<hr class="divider">
	<x-users.filter.header text="choose industry" />
	<x-users.filter.checkbox-list type="indutry" :list="$industries" model="selectedIndustries" />
	<hr class="divider">
	<div class="d-grid">
		<button type="submit" class="btn btn-white text-capitalize">search</button>
	</div>
</form>
