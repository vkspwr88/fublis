<div wire:ignore.self class="modal fade" id="submitInterviewModal" tabindex="-1" aria-labelledby="submitInterviewModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="border-0 modal-header justify-content-center">
				<button type="button" class="btn-close position-absolute" wire:target="cancelSubmit" {{-- data-bs-dismiss="modal" aria-label="Close" --}} style="right: 1rem; top: 1rem;"></button>
			</div>
			<div class="modal-body">
				<div class="py-2 text-center">
					<h4 class="text-purple-700 fs-4 fw-semibold">Submit Interview</h4>
					<p class="text-secondary">Please note that once submitted, you will not be able to edit your answers. If you need to make any changes, please click 'Cancel' to return and edit your responses.</p>
				</div>
			</div>
			<div class="border-0 modal-footer justify-content-center">
				<button wire:click="finalSubmit" class="px-3 btn btn-primary" style="width: 150px;">
					Submit <x-users.spinners.white-btn wire:target="finalSubmit" />
				</button>
				<button wire:click="cancelSubmit" class="px-3 btn btn-secondary" style="width: 150px;">
					Cancel <x-users.spinners.white-btn wire:target="cancelSubmit" />
				</button>
			</div>
		</div>
	</div>
</div>
