<div class="row g-4">
	@forelse ($mediaKits as $mediaKit)
	<x-users.media-kits.architect-card :mediaKit="$mediaKit" />
	@empty
	<div class="col-12">
		<div class="card border-0 rounded-3 bg-white shadow">
			<div class="card-body text-center">
				<h4 class="card-title text-purple-900 fs-5 fw-semibold m-0 py-3">No result found.</h4>
			</div>
		</div>
	</div>
	@endforelse
</div>
