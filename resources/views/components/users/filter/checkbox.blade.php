<div class="form-check">
	<input class="form-check-input filter-checkbox" type="checkbox" value="{{ $item['slug'] }}" id="{{ $type . $item['slug'] }}">
	<label class="form-check-label" for="{{ $type . $item['slug'] }}">{{ $item['name'] }}</label>
</div>
