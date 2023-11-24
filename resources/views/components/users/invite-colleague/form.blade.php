<div class="row">
	<div class="col-md-10 col-lg-8">
		<form wire:submit="submit">
			<div class="row mb-3">
				<label for="inputName" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Name</label>
				<div class="col-md-8">
					<input type="text" id="inputName" class="form-control @error('name') is-invalid @enderror" wire:model="name">
					@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
				</div>
			</div>
			<div class="row mb-3">
				<label for="inputEmail" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Email address</label>
				<div class="col-md-8">
					<input type="text" id="inputEmail" class="form-control @error('email') is-invalid @enderror" wire:model="email">
					@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-md-4">
					<label for="inputMessage" class="col-form-label text-dark fs-6 fw-medium">Invite Message</label>
					<label class="d-block form-text text-secondary fs-7 m-0">Write a nice message invite.</label>
				</div>
				<div class="col-md-8">
					<textarea id="inputMessage" class="form-control @error('inviteMessage') is-invalid @enderror" wire:model="inviteMessage" rows="6" wire:keydown.debounce="characterCount"></textarea>
					@error('inviteMessage')<div class="invalid-feedback">{{ $message }}</div>@enderror
					<div id="inviteMessageHelp" class="form-text {{ $inviteMessageLength < 0 ? 'text-danger' : '' }}">{{ $inviteMessageLength }} characters left</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 text-end">
					<button type="submit" class="btn btn-primary">
						Invite Colleague <x-users.spinners.white-btn wire:target="submit" />
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
