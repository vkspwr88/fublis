<form wire:submit="add" class="pt-4">
	@include('users.includes.architect.add-story.cover-image-field')
	<hr class="border-gray-300">
	<div class="row mb-3">
		<label for="inputPressReleaseTitle" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Press Release Title <span class="text-danger">*</span></label>
		<div class="col-md-8">
			<input type="text" id="inputPressReleaseTitle" class="form-control @error('form.pressReleaseTitle') is-invalid @enderror" wire:model="form.pressReleaseTitle">
			@error('form.pressReleaseTitle')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="row mb-3">
		<label for="inputImageCredits" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Image Credits</label>
		<div class="col-md-8">
			<input type="text" id="inputImageCredits" class="form-control @error('form.imageCredits') is-invalid @enderror" wire:model="form.imageCredits">
			@error('form.imageCredits')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="row mb-3">
		<label for="selectCategory" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Category <span class="text-danger">*</span></label>
		<div class="col-md-8">
			<select id="selectCategory" class="form-select @error('form.category') is-invalid @enderror" wire:model="form.category">
				<option value="">Select Category</option>
				@foreach ($form->categories as $category)
					<option value="{{ $category->id }}">{{ $category->name }}</option>
				@endforeach
			</select>
			@error('form.category')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="row mb-3">
		<div class="col-md-4">
			<label for="inputConceptNote" class="col-form-label text-dark fs-6 fw-medium">Add Concept Note <span class="text-danger">*</span></label>
			<label class="d-block form-text text-secondary fs-7 m-0">Write in 50-75 words (this text will be used in pitch to journalists)</label>
		</div>
		<div class="col-md-8">
			<textarea id="inputConceptNote" class="form-control @error('form.conceptNote') is-invalid @enderror" wire:model="form.conceptNote" wire:keydown.debounce.1000ms="characterCount" rows="6"></textarea>
			@error('form.conceptNote')<div class="invalid-feedback">{{ $message }}</div>@enderror
			<div id="conceptNoteHelp" class="form-text {{ $form->conceptNoteLength < 0 ? 'text-danger' : '' }}">{{ $form->conceptNoteLength }} characters left</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<label for="inputPressReleaseWrite" class="col-form-label text-dark fs-6 fw-medium">Write Press Release <span class="text-danger">*</span></label>
			<label class="d-block form-text text-secondary fs-7 m-0">Add the text in 300-500 words</label>
		</div>
		<div class="col-md-8"  wire:ignore>
			<trix-editor input="inputPressReleaseWrite" x-on:trix-change="$wire.form.pressReleaseWrite = $event.target.value"></trix-editor>
			<input id="inputPressReleaseWrite" type="hidden" wire:model="form.pressReleaseWrite">
			@error('form.pressReleaseWrite')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>

	</div>
	<hr class="border-gray-300">
	<div class="row">
		<div class="col-md-4">
			<label for="" class="col-form-label text-dark fs-6 fw-medium">Upload Press Release <span class="text-danger">*</span></label>
			<label class="d-block form-text text-secondary fs-7 m-0">Add the file as Word document/PDF</label>
		</div>
		<div class="col-md-8">
			<div class="card mb-2">
				<div class="card-body bg-white rounded-3 border border-light">
					<div class="row align-items-center">
						<div class="col-12" x-data="fileUpload('form.pressReleaseFile')">
							<div
								x-on:drop="isDropping = false"
								x-on:drop.prevent="handleFileDrop($event)"
								x-on:dragover.prevent="isDropping = true"
								x-on:dragleave.prevent="isDropping = false"
							>
								<div class="position-absolute top-0 bottom-0 start-0 end-0 z-30 flex justify-content-center align-items-center bg-primary opacity-75 rounded-2" x-show="isDropping" style="display: none;">
									<span class="fs-4 text-white">Release file to upload!</span>
								</div>
								<div class="d-flex justify-content-center align-items-center">
									<div class="upload-icon rounded-circle text-gray-600 fs-5">
										<i class="bi bi-cloud-upload"></i>
									</div>
								</div>
								<p class="card-text text-center text-secondary fs-6 m-0 py-2">
									<label for="pressReleaseFile"><span class="text-purple-700 fw-semibold cursor-pointer">Click to upload</span></label> or drag and drop
								</p>
								<input type="file" id="pressReleaseFile" class="d-none" @change="handleFileSelect">
								@if($form->pressReleaseFile)
									<ul class="mt-3 list-disc">
										@if(method_exists($form->pressReleaseFile, 'getClientOriginalName'))
											<li>
												{{ $form->pressReleaseFile->getClientOriginalName() }}
												<button type="button" class="btn btn-link text-danger text-decoration-none" @click="removeUpload('{{ $form->pressReleaseFile->getFilename() }}')">X</button>
											</li>
										@else
											<li style="list-style: none;">
												<a href="{{ Storage::url($form->pressReleaseFile) }}" class="text-purple-700">See Document</a>
												{{-- <button type="button" class="btn btn-link text-danger text-decoration-none" @click="removeUpload('{{ $form->pressReleaseFile->getFilename() }}')">X</button> --}}
											</li>
										@endif
									</ul>
								@endif
								<div x-show="isUploading" style="display: none;">
									<div class="progress">
										<div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="transition: width 1s" :style="`width: ${progress}%;`"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@error('form.pressReleaseFile')<div class="error">{{ $message }}</div>@enderror
			<div class="input-group">
				<span class="input-group-text bg-white" id="basic-addon1">http://</span>
				<input type="text" class="form-control @error('form.pressReleaseLink') is-invalid @enderror" wire:model="form.pressReleaseLink" placeholder="Insert drive link" aria-describedby="basic-addon1">
				@error('form.pressReleaseLink')<div class="invalid-feedback">{{ $message }}</div>@enderror
			</div>
		</div>
	</div>
	<hr class="border-gray-300">
	<div class="row">
		<div class="col-md-4">
			<label for="inputText" class="col-form-label text-dark fs-6 fw-medium">Upload Photographs</label>
			<label class="d-block form-text text-secondary fs-7 m-0">Choose the best images (maximum upload limit 4MB each image)</label>
		</div>
		<div class="col-md-8">
			<div class="card mb-2">
				<div class="card-body bg-white rounded-3 border border-light">
					<div class="row align-items-center">
						<div class="col-12" x-data="fileUpload('form.photographsFiles')">
							<div
								x-on:drop="isDropping = false"
								x-on:drop.prevent="handleFilesDrop($event)"
								x-on:dragover.prevent="isDropping = true"
								x-on:dragleave.prevent="isDropping = false"
							>
								<div class="position-absolute top-0 bottom-0 start-0 end-0 z-30 flex justify-content-center align-items-center bg-primary opacity-75 rounded-2" x-show="isDropping" style="display: none;">
									<span class="fs-4 text-white">Release file to upload!</span>
								</div>
								<div class="d-flex justify-content-center align-items-center">
									<div class="upload-icon rounded-circle text-gray-600 fs-5">
										<i class="bi bi-cloud-upload"></i>
									</div>
								</div>
								<p class="card-text text-center text-secondary fs-6 m-0 py-2">
									<label for="photographsFiles"><span class="text-purple-700 fw-semibold cursor-pointer">Click to upload</span></label> or drag and drop
								</p>
								<input type="file" id="photographsFiles" class="d-none" @change="handleFilesSelect" multiple>
								@if(count($form->photographsFiles) > 0 || count($form->oldPhotographsFiles) > 0)
									<ul class="d-flex flex-wrap mt-3" style="list-style: none;">
										@foreach ($form->oldPhotographsFiles as $photographsFile)
											<li class="position-relative p-2">
												<img class="img-fluid img-thumbnail" width="150" src="{{ Storage::url($photographsFile->image_path) }}" alt="">
												<button type="button" class="btn btn-sm btn-secondary rounded-circle text-decoration-none position-absolute end-0 top-0" wire:click="removeImage('{{ $photographsFile->id }}')">X</button>
											</li>
										@endforeach
										@foreach ($form->photographsFiles as $key => $photographsFile)
											@if(method_exists($photographsFile, 'temporaryUrl'))
												<li class="position-relative p-2">
													<img class="img-fluid img-thumbnail" width="150" src="{{ $photographsFile->temporaryUrl() }}" alt="">
													<button type="button" class="btn btn-sm btn-secondary rounded-circle text-decoration-none position-absolute end-0 top-0" @click="removeUpload('{{ $photographsFile->getFilename() }}')">X</button>
												</li>
											@else
												<li class="position-relative p-2">
													<img class="img-fluid img-thumbnail" width="150" src="{{ Storage::url($photographsFile) }}" alt="">
													<button type="button" class="btn btn-sm btn-secondary rounded-circle text-decoration-none position-absolute end-0 top-0" wire:click="removeImage({{ $key }})">X</button>
												</li>
											@endif
										@endforeach
									</ul>
								@endif
								<div x-show="isUploading" style="display: none;">
									<div class="progress">
										<div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="transition: width 1s" :style="`width: ${progress}%;`"></div>
									</div>
								</div>
							</div>
						</div>

						{{-- <div class="col-md-4">
							<div class="card">
								<div class="card-body bg-white rounded-3 border border-light">
									<div class="row align-items-center">
										<div class="col-12">
											<div class="d-flex justify-content-center align-items-center">
												<div class="upload-icon rounded-circle text-gray-600 fs-5">
													<i class="bi bi-cloud-upload"></i>
												</div>
											</div>
											<p class="card-text text-center text-purple-700 fw-semibold fs-6 m-0 py-2">Click to upload</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="d-flex flex-column justify-content-center align-items-center">
								<div class="text-center fs-1 rounded-circle bg-white" style="color: #9E9E9E;"><i class="bi bi-plus"></i></div>
								<p class="text-center text-gray-600 fs-6 m-0 py-2">Add more</p>
							</div>
						</div> --}}
					</div>
				</div>
			</div>
			@error('form.photographsFiles')<div class="error">{{ $message }}</div>@enderror
			@error('form.photographsFiles.*')<div class="error">{{ $message }}</div>@enderror
			<div class="input-group">
				<span class="input-group-text bg-white" id="basic-addon1">http://</span>
				<input type="text" class="form-control @error('form.photographsLink') is-invalid @enderror" wire:model="form.photographsLink" placeholder="Insert drive link" aria-describedby="basic-addon1">
				@error('form.photographsLink')<div class="invalid-feedback">{{ $message }}</div>@enderror
			</div>
		</div>
	</div>
	<hr class="border-gray-300">
	<div class="row mb-3">
		<label for="inputTags" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Tags</label>
		<div class="col-md-8">
			@include('users.includes.input-tags')
		</div>
	</div>
	<div class="row mb-3">
		<div class="col-md-4">
			<label for="selectMediaContact" class="col-form-label text-dark fs-6 fw-medium">Select Media Contact <span class="text-danger">*</span></label>
			<label class="d-block form-text text-secondary fs-7 m-0">Pick the team member who can best respond to journalists queries</label>
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
			<label class="d-block form-text text-secondary fs-7 m-0">Set level of access for journalists</label>
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
	<hr class="border-gray-300">
	<div class="text-end">
		@empty($edit)
			<button class="btn btn-white fs-6 fw-semibold" type="button" wire:click="draft">
				Save as Draft <x-users.spinners.primary-btn wire:target="draft" />
			</button>
			<button class="btn btn-white fs-6 fw-semibold" type="button" wire:click="preview">
				Preview <x-users.spinners.primary-btn wire:target="preview" />
			</button>
		@endempty
		<button class="btn btn-primary fs-6 fw-semibold" type="submit">
			{{ isset($edit) ? 'Edit Press Release' : 'Submit Press Release' }} <x-users.spinners.white-btn wire:target="add" />
		</button>
	</div>
	@include('users.includes.common.file-upload-script', ['width' => 800, 'height' => 400])
	<script>
		const editor = document.querySelector("trix-editor");
		editor.editor.insertHTML('{!! $form->pressReleaseWrite !!}');
	</script>
</form>
