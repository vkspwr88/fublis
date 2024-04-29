<div class="row">
	<div class="col-md-4">
		<label for="inputText" class="col-form-label text-dark fs-6 fw-medium">Audio / Video Link</label>
		{{-- <label class="m-0 d-block form-text text-secondary fs-7">Choose the best images (maximum upload limit 4MB each image)</label> --}}
	</div>
	<div class="col-md-8">
		<input type="text" class="form-control @error('form.audioVideoUrl') is-invalid @enderror" wire:model="form.audioVideoUrl" placeholder="Audio / Video Link">
	</div>
</div>
