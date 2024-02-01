<form class="py-3" wire:submit="submit">
	@include('users.includes.error-alert')
	<div class="mb-3">
		<label for="inputConfirmPassword" class="form-label">New Password<span class="text-danger">*</span></label>
		<div class="input-group">
			<input type="password" class="form-control border-end-0 @error('password_confirmation') is-invalid @enderror" id="inputConfirmPassword" placeholder="Enter your password" wire:model="password_confirmation">
			<button id="inputConfirmPasswordToggle" class="btn btn-outline-white border border-start-0 @error('password_confirmation') border-danger @enderror" type="button" onclick="togglePassword('#inputConfirmPassword')">
				<i class="bi bi-eye"></i>
			</button>
		</div>
		@error('password_confirmation')<div class="error">{{ $message }}</div>@enderror
	</div>
	<div class="mb-3">
		<label for="inputPassword" class="form-label">Confirm new Password<span class="text-danger">*</span></label>
		<div class="input-group">
			<input type="password" class="form-control border-end-0 @error('password') is-invalid @enderror" id="inputPassword" placeholder="Enter your password" wire:model="password">
			<button id="inputPasswordToggle" class="btn btn-outline-white border border-start-0 @error('password') border-danger @enderror" type="button" onclick="togglePassword('#inputPassword')">
				<i class="bi bi-eye"></i>
			</button>
		</div>
		@error('password')<div class="error">{{ $message }}</div>@enderror
		@error('email')<div class="error">{{ $message }}</div>@enderror
		@error('token')<div class="error">{{ $message }}</div>@enderror
	</div>
	<div class="d-grid gap-3">
		<button class="btn btn-primary fs-6 fw-semibold" type="submit">
			Reset Password <x-users.spinners.white-btn wire:target="submit" />
		</button>
	</div>
</form>
