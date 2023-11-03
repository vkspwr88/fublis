{{-- <div class="row g-4">
	@forelse ($mediaKits as $mediaKit)
		@if (str()->contains($mediaKit->story_type, 'PressRelease'))
			<livewire:architects.media-kits.press-releases.view :pressRelease="$mediaKit" :key="$mediaKit->id" />
		@elseif (str()->contains($mediaKit->story_type, 'Article'))
			<livewire:architects.media-kits.articles.view :article="$mediaKit" :key="$mediaKit->id" />
		@elseif (str()->contains($mediaKit->story_type, 'Project'))
			<livewire:architects.media-kits.projects.view :project="$mediaKit" :key="$mediaKit->id" />
		@endif
	@empty
	<div class="col-12">
		<div class="card border-0 rounded-3 bg-white shadow">
			<div class="card-body text-center">
				<h4 class="card-title text-purple-900 fs-5 fw-semibold m-0 py-3">No media kit added by you.<br>Start creating your media kits now.</h4>
				<p class="card-text m-0 py-3">
					<a class="btn btn-primary fs-6 fw-semibold" href="{{ route('architect.add-story.index') }}">Add Story</a>
				</p>
			</div>
		</div>
	</div>
	@endforelse
</div> --}}
<x-users.media-kits.architect-list :mediaKits="$mediaKits" />
