<div>
	@if($mediaKits->count() > 0)
		<div class="row g-4">
			@foreach ($mediaKits as $mediaKit)
				<x-users.media-kits.architect-card :mediaKit="$mediaKit" />
			@endforeach
		</div>
		{{ $mediaKits->links('vendor.livewire.custom-pagination') }}
	@else
	<div class="row">
		<div class="col-12">
			<div class="card border-0 rounded-3 bg-white shadow">
				<div class="card-body text-center">
					<h4 class="card-title text-purple-900 fs-5 fw-semibold m-0 py-3">No result found.</h4>
				</div>
			</div>
		</div>
	</div>
	@endif
</div>
