<div>
	<div class="row g-4 justify-content-end align-items-end">
		<div class="col">
			<div class="d-flex justify-content-start">
				<h2 class="text-dark fs-3 fw-semibold m-0">Preview</h2>
			</div>
		</div>
		<div class="col-auto">
			<div class="row justify-content-end align-items-end gx-0 gy-3">
				<div class="col-auto">
					<a href="{{ route('journalist.call.create') }}" class="btn btn-link text-decoration-none text-purple-600 fw-semibold">
						<i class="bi bi-plus"></i> Create New Call
					</a>
				</div>
				<div class="col-auto">
					<a href="{{ route('architect.media-kit.index') }}" class="btn btn-white text-dark fw-semibold">
						<i class="bi bi-stack"></i> All Media kits
					</a>
				</div>
			</div>
		</div>
	</div>
	<hr class="border-gray-300 my-4">
	<div class="row justify-content-center">
		<div class="col-md-9">
			@include('livewire.journalists.calls.view')
			<hr class="border-gray-300 my-3">
			<div class="row g-4">
				<div class="col">
					<div class="text-end">
						<button class="btn btn-white fw-semibold" type="button" wire:click="previousStep">Cancel</button>
						<button class="btn btn-primary fw-semibold" type="button" wire:click="update">Invite Stories</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
