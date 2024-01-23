<div class="row g-4">
	<div class="col-md-8 offset-md-4">
		<div class="text-start">
			<button type="button" class="btn btn-primary fw-semibold" wire:click="showMediaKit">
				Submit Story <x-users.spinners.white-btn wire:target="showMediaKit" />
			</button>
		</div>
	</div>
	@include('users.includes.architect.pitch-story-modals')
</div>
