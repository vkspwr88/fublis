<form wire:submit="search">
    <livewire:users.blogs.index.search-input />
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
