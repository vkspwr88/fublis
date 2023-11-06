<form wire:submit="update">
	<div class="row pt-4 g-4 justify-content-end align-items-end">
		<div class="col">
			<h4 class="text-dark fs-6 fw-semibold m-0 p-0">Password</h4>
			<p class="text-secondary fs-6 m-0 p-0">
				<small>Please enter your current password to change your password.</small>
			</p>
		</div>
	</div>

	<hr class="border-gray-300 my-4">

	<div class="row">
		<div class="col-md-8">
			<div class="row">
				<label for="inputPassword" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Current password</label>
				<div class="col-md-8">
					<input type="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" wire:model="password">
					@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
				</div>
			</div>
			<hr class="border-gray-300">
			<div class="row">
				<label for="inputConfirmNewPassword" class="col-md-4 col-form-label text-dark fs-6 fw-medium">New password</label>
				<div class="col-md-8">
					<input type="password" id="inputConfirmNewPassword" class="form-control @error('newPassword_confirmation') is-invalid @enderror" wire:model="newPassword_confirmation">
					@error('newPassword_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
				</div>
			</div>
			<hr class="border-gray-300">
			<div class="row">
				<label for="inputNewPassword" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Confirm new password</label>
				<div class="col-md-8">
					<input type="password" id="inputNewPassword" class="form-control @error('newPassword') is-invalid @enderror" wire:model="newPassword">
					@error('newPassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
				</div>
			</div>
			<hr class="border-gray-300">
			<div class="row justify-content-end align-items-end g-2">
				<div class="col-auto">
					<button type="button" class="btn btn-white fw-medium" wire:click="refresh">
						Cancel <x-users.spinners.primary-btn wire:target="refresh" />
					</button>
				</div>
				<div class="col-auto">
					<button type="submit" class="btn btn-primary fw-medium">
						Update password <x-users.spinners.white-btn wire:target="update" />
					</button>
				</div>
			</div>
		</div>
	</div>
</form>
