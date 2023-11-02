<div class="col-12">
	<div class="card border-0 rounded-3 bg-white shadow">
		<div class="card-body">
			@if (str()->contains($mediaKit->story_type, 'PressRelease'))
				<livewire:journalists.media-kits.press-releases.view :pressRelease="$mediaKit" :key="$mediaKit->id" />
			@elseif (str()->contains($mediaKit->story_type, 'Article'))
				<livewire:journalists.media-kits.articles.view :article="$mediaKit" :key="$mediaKit->id" />
			@elseif (str()->contains($mediaKit->story_type, 'Project'))
				<livewire:journalists.media-kits.projects.view :project="$mediaKit" :key="$mediaKit->id" />
			@endif
		</div>
	</div>
</div>