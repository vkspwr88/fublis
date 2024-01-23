<div class="row g-0 mb-4">
	<div class="col">
		<div class="d-grid">
			<input type="radio" class="btn-check btn-filter-check" name="options-outlined" autocomplete="off" {{ $type == 'call' ? 'checked' : '' }}>
			<label class="btn btn-outline-primary rounded-0 fw-semibold">
				<a href="{{ route('journalist.call.all') }}" class="{{ $type == 'call' ? 'text-purple-700' : 'text-gray-500' }}">Calls</a>
			</label>
		</div>
	</div>
	<div class="col">
		<div class="d-grid">
			<input type="radio" class="btn-check btn-filter-check" name="options-outlined" autocomplete="off" {{ $type == 'publication' ? 'checked' : '' }}>
			<label class="btn btn-outline-primary rounded-0 fw-semibold">
				<a href="{{ route('journalist.account.profile.publications.index') }}" class="{{ $type == 'publication' ? 'text-purple-700' : 'text-gray-500' }}">Publications</a>
			</label>
		</div>
	</div>
	<div class="col">
		<div class="d-grid">
			<input type="radio" class="btn-check btn-filter-check" name="options-outlined" autocomplete="off" {{ $type == 'journalist' ? 'checked' : '' }}>
			<label class="btn btn-outline-primary rounded-0 fw-semibold">
				<a href="{{ route('journalist.account.profile.journalists.index') }}" class="{{ $type == 'journalist' ? 'text-purple-700' : 'text-gray-500' }}">Journalists</a>
			</label>
		</div>
	</div>	
</div>
