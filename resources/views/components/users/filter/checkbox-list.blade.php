<div class="filter-checkbox-container">
	@foreach ($list as $item)
		<x-users.filter.checkbox :item="$item" :type="$type" />
	@endforeach

	{{-- <x-users.filter.checkbox text="Checked checkbox" /> --}}
	{{-- <div class="form-check">
		<input class="form-check-input filter-checkbox" type="checkbox" value="" id="flexCheckDefault">
		<label class="form-check-label" for="flexCheckDefault">Default checkbox</label>
	</div>
	<div class="form-check">
		<input class="form-check-input filter-checkbox" type="checkbox" value="" id="flexCheckChecked">
		<label class="form-check-label" for="flexCheckChecked">Checked checkbox</label>
	</div> --}}
</div>
