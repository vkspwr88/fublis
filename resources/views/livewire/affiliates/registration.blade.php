<form class="py-3" wire:submit="submit">
	<div class="row g-3">
		<div class="col-12">
			<label for="inputName" class="form-label text-dark fs-6 fw-medium">Name*</label>
			<input type="text" class="form-control  @error('name') is-invalid @enderror" id="inputName" placeholder="Your registerred name with Fublis" wire:model.blur="name">
			@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
		<div class="col-12">
			<label for="inputEmail" class="form-label text-dark fs-6 fw-medium">Email*</label>
			<input type="text" class="form-control  @error('email') is-invalid @enderror" id="inputEmail" placeholder="Your registerred email with Fublis" wire:model.blur="email">
			@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
		<div class="col-12">
			<label for="inputPublicationName" class="form-label text-dark fs-6 fw-medium">Publication Name*</label>
			<input type="text" class="form-control  @error('publication_name') is-invalid @enderror" id="inputPublicationName" placeholder="Share your publication name" wire:model.blur="publication_name">
			@error('publication_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
			<p class="m-0 text-muted">Must be at least 8 characters.</p>
		</div>
		<div class="col-12">
			<label for="inputPublicationUrl" class="form-label text-dark fs-6 fw-medium">Publication URL*</label>
			<input type="text" class="form-control  @error('publication_url') is-invalid @enderror" id="inputPublicationUrl" placeholder="Share link to your wbesite/ page" wire:model.blur="publication_url">
			@error('publication_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
		<div class="col-12">
			<label for="inputExplaination" class="form-label text-dark fs-6 fw-medium">How will you promote us?*</label>
			<textarea rows="5" class="form-control  @error('how_will_you_promote_us') is-invalid @enderror" id="inputExplaination" placeholder="Explain how will you promote Fublis to your readers/ users?" wire:model.blur="how_will_you_promote_us"></textarea>
			@error('how_will_you_promote_us')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
		<div class="col-12">
			<div class="d-grid">
				<button class="btn btn-primary fs-6 fw-semibold" type="submit">
					Submit <x-users.spinners.white-btn wire:target="submit" />
				</button>
			</div>
		</div>
		<div wire:ignore.self class="modal fade" id="successRegistrationModal" tabindex="-1" aria-labelledby="successRegistrationLabel" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false" data-keyboard="false" style="background: #666 !important; margin: 0;">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body">
						<div class="py-2 text-center">
							<h4 class="text-purple-700 fs-4 fw-semibold">Thank You for Applying to Become a Fublis Affiliate!</h4>
							<p class="text-secondary">We're excited to have you join our Affiliate Program and help promote Fublis memberships. Your application has been received and is under review. You will receive an email notification with the outcome of your application in the coming 5 days.</p>
							<p class="m-0">
								<button type="button" class="btn btn-primary fw-medium" data-bs-dismiss="modal" aria-label="Close" style="width: 150px;">Close</button>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
