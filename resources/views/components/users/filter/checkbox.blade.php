<div class="form-check">
	<input class="form-check-input filter-checkbox" type="checkbox" value="{{ $item['id'] }}" id="{{ $type . $item['id'] }}">
	<label class="form-check-label" for="{{ $type . $item['id'] }}">{{ $item['name'] }}</label>
</div>
