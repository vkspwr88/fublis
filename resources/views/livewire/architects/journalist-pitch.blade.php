<div class="d-grid">
	<button type="button" class="btn btn-primary fw-medium" wire:click="showMediaKit('{{ $journalist->id }}')">
		Submit Story <x-users.spinners.white-btn wire:target="showMediaKit('{{ $journalist->id }}')" />
	</button>
	@include('users.includes.architect.pitch-story-modals')
	@include('users.includes.architect.pitch-story-modals-success-journalist')
</div>
