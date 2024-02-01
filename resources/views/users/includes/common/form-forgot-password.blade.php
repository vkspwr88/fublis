<form class="py-3" wire:submit="submit">
	@include('users.includes.error-alert')
	<div class="mb-3">
		<label for="inputEmail" class="form-label text-dark fs-6 fw-medium">Email<span class="text-danger">*</span></label>
		<input type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" placeholder="Enter your email" wire:model="email">
		@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="d-grid gap-3">
		<button class="btn btn-primary fs-6 fw-semibold" type="submit">
			Reset <x-users.spinners.white-btn wire:target="submit" />
		</button>
	</div>
</form>
