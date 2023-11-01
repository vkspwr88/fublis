<div>
	<select :model="$model" class="form-select">
		<option>Choose {{ $type }}</option>
		{{-- {{ dd($list) }} --}}
		@foreach ($list as $item)
		<option value="{{ $item->id }}">{{ $item->name }}</option>
		@endforeach
	</select>
</div>
