<div class="d-grid">
	<button type="button" class="btn btn-primary fw-medium" wire:click="showMediaKit(true)">
		Submit Story <x-users.spinners.white-btn wire:target="showMediaKit(true)" />
	</button>
	@include('users.includes.architect.pitch-story-modals')
</div>
