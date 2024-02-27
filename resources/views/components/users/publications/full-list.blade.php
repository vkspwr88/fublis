<div>
    @if($publications->count() > 0)
		<div class="row g-4">
			@foreach ($publications as $publication)
				<x-users.publications.card :publication="$publication" />
			@endforeach
		</div>
		{{ $publications->links('vendor.livewire.custom-pagination') }}
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
