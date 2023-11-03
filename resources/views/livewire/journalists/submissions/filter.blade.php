<form wire:submit="search">
	@include('users.includes.journalist.media-kit-nav-types', ['type' => 'submission'])
	<div class="input-group mb-4">
		<label class="input-group-text bg-white" for="filterSearchInput"><i class="bi bi-search"></i></label>
		<input id="filterSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search by name" aria-label="Search" />
	</div>
	<div class="row g-2">
	@forelse ($calls as $call)
		<div class="col-12">
			<input type="radio" id="call-{{ $call->id }}" value="{{ $call->id }}" name="call" class="position-absolute opacity-0 list-radio">
			<div class="px-3 py-2 rounded-3">
				<label for="call-{{ $call->id }}" class="fw-semibold fs-6 d-block">{{ $call->title }}</label>
			</div>
		</div>
	@empty
		<div class="col-12">
			<h5 class="text-center">No Calls</h5>
		</div>
	@endforelse
	</div>
</form>
