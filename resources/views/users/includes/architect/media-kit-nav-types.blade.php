<div class="row g-0 mb-4">
	<div class="col">
		<div class="d-grid">
			<input type="radio" class="btn-check btn-filter-check" name="published-outlined" autocomplete="off" {{ $type == 'published' ? 'checked' : '' }}>
			<label class="btn btn-outline-primary rounded-0 fw-semibold">
				<a href="{{ route('architect.media-kit.index') }}" class="{{ $type == 'published' ? 'text-purple-700' : 'text-gray-500' }}">Published</a>
			</label>
		</div>
	</div>
	<div class="col">
		<div class="d-grid">
			<input type="radio" class="btn-check btn-filter-check" name="draft-outlined" autocomplete="off" {{ $type == 'draft' ? 'checked' : '' }}>
			<label class="btn btn-outline-primary rounded-0 fw-semibold">
				<a href="{{ route('architect.add-story.draft.index') }}" class="{{ $type == 'draft' ? 'text-purple-700' : 'text-gray-500' }}">Drafts</a>
			</label>
		</div>
	</div>
</div>