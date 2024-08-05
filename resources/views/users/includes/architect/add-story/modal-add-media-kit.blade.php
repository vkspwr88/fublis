<div wire:ignore.self class="modal fade" id="addMediaKitAlertModal" tabindex="-1" aria-labelledby="addMediaKitAlertLabel" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false" data-keyboard="false" style="background: #666 !important;">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<div class="py-2 text-center">
					<h4 class="text-purple-700 fs-4 fw-semibold">Upgrade Your Account to Keep Pitching!</h4>
					<p class="text-secondary">You've reached the limit of pitches allowed in your {{-- free  --}}account per month. Upgrade now to continue sharing your stories and take advantage of unlimited pitching, advanced features, and premium support.</p>
					<p>
						<a href="{{ route('pricing') }}" class="btn btn-primary fw-medium" style="width: 150px;">Upgrade</a>
					</p>
					<p class="m-0">
						<button type="button" class="btn btn-secondary fw-medium" data-bs-dismiss="modal" aria-label="Close" style="width: 150px;">Return</button>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>