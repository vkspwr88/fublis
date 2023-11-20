<div>
	<select wire:model="$model" class="form-select">
		<option value="">Choose {{ $type }}</option>
		{{-- {{ dd($list) }} --}}
		@foreach ($list as $item)
		<option value="{{ $item->id }}">{{ $item->name }}</option>
		@endforeach
	</select>
</div>
