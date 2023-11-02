<form wire:submit="search">
	@include('users.includes.journalist.media-kit-nav-types', ['type' => 'brand'])
	<div class="input-group mb-4">
		<label class="input-group-text bg-white" for="filterSearchInput"><i class="bi bi-search"></i></label>
		<input id="filterSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search by name" aria-label="Search" />
	</div>
	<x-users.filter.header text="Location" />
	<x-users.filter.select type="location" :list="$locations" model="selectLocation" />
	<hr class="divider">
	<x-users.filter.header text="Categories" />
	<x-users.filter.checkbox-list type="category" :list="$categories" model="selectedCategories" />
	{{-- <x-users.filter.header text="Project Types" />
	<x-users.filter.checkbox-list type="category" :list="$projectTypes" model="selectedProjectTypes" /> --}}
	<hr class="divider">
	<div class="d-grid">
		<button type="submit" class="btn btn-white text-capitalize">search</button>
	</div>
</form>
