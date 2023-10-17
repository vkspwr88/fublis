<div class="row g-0 mb-4">
	<div class="col">
		<div class="d-grid">
			<input type="radio" class="btn-check btn-filter-check" name="options-outlined" id="publications-outlined" autocomplete="off" {{ $type == 'publication' ? 'checked' : '' }}>
			<label class="btn btn-outline-primary rounded-0 fw-semibold" for="publications-outlined">
				<a href="{{ route('architect.pitch-story.publications.index') }}" class="{{ $type == 'publication' ? 'text-purple-700' : 'text-gray-500' }}">Publications</a>
			</label>
		</div>
	</div>
	<div class="col">
		<div class="d-grid">
			<input type="radio" class="btn-check btn-filter-check" name="options-outlined" id="journalists-outlined" autocomplete="off" {{ $type == 'journalist' ? 'checked' : '' }}>
			<label class="btn btn-outline-primary rounded-0 fw-semibold" for="journalists-outlined">
				<a href="{{ route('architect.pitch-story.journalists.index') }}" class="{{ $type == 'journalist' ? 'text-purple-700' : 'text-gray-500' }}">Journalists</a>
			</label>
		</div>
	</div>
	<div class="col">
		<div class="d-grid">
			<input type="radio" class="btn-check btn-filter-check" name="options-outlined" id="calls-outlined" autocomplete="off" {{ $type == 'call' ? 'checked' : '' }}>
			<label class="btn btn-outline-primary rounded-0 fw-semibold" for="calls-outlined">
				<a href="{{ route('architect.pitch-story.calls.index') }}" class="{{ $type == 'call' ? 'text-purple-700' : 'text-gray-500' }}">Calls</a>
			</label>
		</div>
	</div>
</div>
