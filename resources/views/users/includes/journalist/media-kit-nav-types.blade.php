<div class="row g-0 mb-4">
	<div class="col">
		<div class="d-grid">
			<input type="radio" class="btn-check btn-filter-check" name="options-outlined" id="media-kit-outlined" autocomplete="off" {{ $type == 'media-kit' ? 'checked' : '' }}>
			<label class="btn btn-outline-primary rounded-0 fw-semibold text-nowrap" for="media-kit-outlined">
				<a href="{{ route('journalist.media-kit.index') }}" class="{{ $type == 'media-kit' ? 'text-purple-700' : 'text-gray-500' }}">Media Kits</a>
			</label>
		</div>
	</div>
	<div class="col">
		<div class="d-grid">
			<input type="radio" class="btn-check btn-filter-check" name="options-outlined" id="brand-outlined" autocomplete="off" {{ $type == 'brand' ? 'checked' : '' }}>
			<label class="btn btn-outline-primary rounded-0 fw-semibold text-nowrap" for="brand-outlined">
				<a href="{{ route('journalist.brand.index') }}" class="{{ $type == 'brand' ? 'text-purple-700' : 'text-gray-500' }}">Brands</a>
			</label>
		</div>
	</div>
	<div class="col">
		<div class="d-grid">
			<input type="radio" class="btn-check btn-filter-check" name="options-outlined" id="submission-outlined" autocomplete="off" {{ $type == 'submission' ? 'checked' : '' }}>
			<label class="btn btn-outline-primary rounded-0 fw-semibold text-nowrap" for="submission-outlined">
				<a href="{{ route('journalist.submission.index') }}" class="{{ $type == 'submission' ? 'text-purple-700' : 'text-gray-500' }}">Submissions</a>
			</label>
		</div>
	</div>
</div>
