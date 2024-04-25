<div class="mb-4 row g-0">
	<div class="col">
		<div class="d-grid">
			<a href="{{ route('journalist.media-kit.index') }}" class="{{ $type == 'media-kit' ? 'text-purple-700' : 'text-gray-500' }}">
				<input type="radio" class="btn-check btn-filter-check" name="options-outlined" autocomplete="off" {{ $type == 'media-kit' ? 'checked' : '' }}>
				<label class="btn btn-outline-primary rounded-0 fw-semibold text-nowrap">Media Kits</label>
			</a>
		</div>
	</div>
	<div class="col">
		<div class="d-grid">
			<a href="{{ route('journalist.brand.index') }}" class="{{ $type == 'brand' ? 'text-purple-700' : 'text-gray-500' }}">
				<input type="radio" class="btn-check btn-filter-check" name="options-outlined" autocomplete="off" {{ $type == 'brand' ? 'checked' : '' }}>
				<label class="btn btn-outline-primary rounded-0 fw-semibold text-nowrap">Brands</label>
			</a>
		</div>
	</div>
	<div class="col">
		<div class="d-grid">
			<a href="{{ route('journalist.submission.index') }}" class="{{ $type == 'submission' ? 'text-purple-700' : 'text-gray-500' }}">
				<input type="radio" class="btn-check btn-filter-check" name="options-outlined" autocomplete="off" {{ $type == 'submission' ? 'checked' : '' }}>
				<label class="btn btn-outline-primary rounded-0 fw-semibold text-nowrap">Submissions</label>
			</a>
		</div>
	</div>
</div>
