<div wire:ignore.self class="modal fade" id="pitchSuccessModal" tabindex="-1" aria-labelledby="pitchSuccessLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header justify-content-center border-0">
				<button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="right: 1rem; top: 1rem;"></button>
			</div>
			<div class="modal-body">
				<div class="d-flex justify-content-center align-items-center border rounded-3 py-2">
					<h4 class="fs2 text-purple-900 text-center fw-semibold m-0">Your story has been<br>successfully submitted.</h4>
				</div>
			</div>
			<div class="modal-footer justify-content-center border-0">
				<a href="{{ route('architect.pitch-story.publications.index') }}" class="btn btn-primary px-3">
					Pitch to another Publication <i class="bi bi-send-fill"></i>
				</a>
			</div>
		</div>
	</div>
</div>
