<div wire:ignore.self class="modal fade" id="deleteMediaKitModal" tabindex="-1" aria-labelledby="deleteMediaKitLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="border-0 modal-header justify-content-center">
				<button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="right: 1rem; top: 1rem;"></button>
			</div>
			<div class="modal-body">
				<div class="py-2 border d-flex justify-content-center align-items-center rounded-3">
					<h4 class="m-0 text-center text-purple-900 fs2 fw-semibold">Are you sure you want to delete this mediakit?</h4>
				</div>
			</div>
			<div class="border-0 modal-footer justify-content-center">
				<button type="button" wire:click="deleteMediaKit" class="px-3 btn btn-primary">
					Delete Media Kit <x-users.spinners.white-btn wire:target="deleteMediaKit" />
				</button>
			</div>
		</div>
	</div>
</div>
@include('users.includes.architect.add-story.modal-add-media-kit')
