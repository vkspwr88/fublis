<div class="filter-checkbox-container">
	@foreach ($list as $item)
		@if($item)
			<x-users.filter.checkbox :item="$item" :type="$type" :model="$model" />
		@endif
	@endforeach
</div>
