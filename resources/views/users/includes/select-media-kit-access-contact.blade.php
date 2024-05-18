<div class="mb-3 row">
	<div class="col-md-4">
		<label for="selectMediaContact" class="col-form-label text-dark fs-6 fw-medium">Select Media Contact <span class="text-danger">*</span></label>
		<label class="m-0 d-block form-text text-secondary fs-7">Pick the team member who can best respond to journalists queries</label>
	</div>
	<div class="col-md-8">
		<select id="selectMediaContact" class="form-select @error('form.mediaContact') is-invalid @enderror" wire:model="form.mediaContact">
			<option value="">Select Media Contact</option>
			@foreach ($form->mediaContacts as $mediaContact)
				<option value="{{ $mediaContact->id }}">{{ $mediaContact->user->name }}</option>
			@endforeach
		</select>
		@error('form.mediaContact')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<label for="selectMediaKitAccess" class="col-form-label text-dark fs-6 fw-medium">Media Kit Access <span class="text-danger">*</span></label>
		<label class="m-0 d-block form-text text-secondary fs-7">
			Set level of access for journalists
			<br>
			<strong>Open to all:</strong> Journalists can download without asking for permission; however you'll get the notification about who downloaded the kit.
			<br>
			<strong>Private:</strong> Journalists will request access to download.
		</label>
	</div>
	<div class="col-md-8">
		<select id="selectMediaKitAccess" class="form-select @error('form.mediaKitAccess') is-invalid @enderror" wire:model="form.mediaKitAccess">
			<option value="">Select Media Kit Access</option>
			@foreach ($form->projectAccess as $mediaKitAccess)
				<option value="{{ $mediaKitAccess->id }}">{{ $mediaKitAccess->name }}</option>
			@endforeach
		</select>
		@error('form.mediaKitAccess')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
</div>