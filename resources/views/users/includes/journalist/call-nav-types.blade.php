<div class="mb-4 row g-0">
	<div class="col">
		<div class="d-grid">
			<a href="{{ route('journalist.call.all') }}" class="{{ $type == 'call' ? 'text-purple-700' : 'text-gray-500' }}">
				<input type="radio" class="btn-check btn-filter-check" name="options-outlined" autocomplete="off" {{ $type == 'call' ? 'checked' : '' }}>
				<label class="btn btn-outline-primary rounded-0 fw-semibold">Calls</label>
			</a>
		</div>
	</div>
	<div class="col">
		<div class="d-grid">
			<a href="{{ route('journalist.account.profile.publications.index') }}" class="{{ $type == 'publication' ? 'text-purple-700' : 'text-gray-500' }}">
				<input type="radio" class="btn-check btn-filter-check" name="options-outlined" autocomplete="off" {{ $type == 'publication' ? 'checked' : '' }}>
				<label class="btn btn-outline-primary rounded-0 fw-semibold">Publications</label>
			</a>
			{{-- <input type="radio" class="btn-check btn-filter-check" name="options-outlined" autocomplete="off" {{ $type == 'publication' ? 'checked' : '' }}>
			<label class="btn btn-outline-primary rounded-0 fw-semibold">
				<a href="{{ route('journalist.account.profile.publications.index') }}" class="{{ $type == 'publication' ? 'text-purple-700' : 'text-gray-500' }}">Publications</a>
			</label> --}}
		</div>
	</div>
	<div class="col">
		<div class="d-grid">
			<a href="{{ route('journalist.account.profile.journalists.index') }}" class="{{ $type == 'journalist' ? 'text-purple-700' : 'text-gray-500' }}">
				<input type="radio" class="btn-check btn-filter-check" name="options-outlined" autocomplete="off" {{ $type == 'journalist' ? 'checked' : '' }}>
				<label class="btn btn-outline-primary rounded-0 fw-semibold">Journalists</label>
			</a>
		</div>
	</div>
</div>
