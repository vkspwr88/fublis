<div class="filter-checkbox-container">
	@foreach ($list as $item)
		<x-users.filter.checkbox :item="$item" :type="$type" />
	@endforeach
</div>
