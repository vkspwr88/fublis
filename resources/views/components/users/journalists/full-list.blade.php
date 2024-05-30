<div>
    @if($journalists->count() > 0)
		<div class="row g-4">
			@foreach ($journalists as $journalist)
				@if($journalist->publications[0])
                	<x-users.journalists.card :journalist="$journalist" />
				@endif
			@endforeach
		</div>
		{{ $journalists->links('vendor.livewire.custom-pagination') }}
		@else
		<div class="row">
			<div class="col-12">
				<div class="card border-0 rounded-3 bg-white shadow">
					<div class="card-body">
						<h5 class="fs-5 text-purple-700 text-center">No Result Found</h5>
					</div>
				</div>
			</div>
		</div>
    @endif
</div>
