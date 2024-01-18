<form wire:submit="add" class="pt-4">
	<div class="row">
		<div class="col-md-4">
			<label for="inputText" class="col-form-label text-dark fs-6 fw-medium">Cover Image <span class="text-danger">*</span></label>
			<label class="d-block form-text text-secondary fs-7 m-0">This will be displayed on your media kit.</label>
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-body bg-white rounded-3 border border-light">
					<div class="row align-items-center g-4">
						<div class="col-12" x-data="fileUpload('coverImage')">
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
									<label for="inputCoverImage"><span class="text-purple-700 fw-semibold cursor-pointer">Click to upload</span></label> or drag and drop
								</p>
								<input type="file" id="inputCoverImage" class="d-none" accept="image/svg,image/png,image/jpg,image/gif" @change="handleFileSelect">
								<p class="card-text text-center text-secondary fs-6 m-0 py-2">SVG, PNG, JPG or GIF (max. 800x400px)</p>
								@if($coverImage)
									<ul class="mt-3 list-disc">
										<li>
											{{ $coverImage->getClientOriginalName() }}
											<button type="button" class="btn btn-link text-danger text-decoration-none" @click="removeUpload('{{ $coverImage->getFilename() }}')">X</button>
										</li>
									</ul>
								@endif
								<div x-show="isUploading" style="display: none;">
									<div class="progress">
										<div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" :style="`width: ${progress}%;`"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@error('coverImage')<div class="error">{{ $message }}</div>@enderror
		</div>
	</div>
	<hr class="border-gray-300">
	<div class="row mb-3">
		<label for="inputPressReleaseTitle" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Press Release Title <span class="text-danger">*</span></label>
		<div class="col-md-8">
			<input type="text" id="inputPressReleaseTitle" class="form-control @error('pressReleaseTitle') is-invalid @enderror" wire:model="pressReleaseTitle">
			@error('pressReleaseTitle')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="row mb-3">
		<label for="inputImageCredits" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Image Credits</label>
		<div class="col-md-8">
			<input type="text" id="inputImageCredits" class="form-control @error('imageCredits') is-invalid @enderror" wire:model="imageCredits">
			@error('imageCredits')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="row mb-3">
		<label for="selectCategory" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Category <span class="text-danger">*</span></label>
		<div class="col-md-8">
			<select id="selectCategory" class="form-select @error('category') is-invalid @enderror" wire:model="category">
				<option value="">Select Category</option>
				@foreach ($categories as $category)
					<option value="{{ $category->id }}">{{ $category->name }}</option>
				@endforeach
			</select>
			@error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="row mb-3">
		<div class="col-md-4">
			<label for="inputConceptNote" class="col-form-label text-dark fs-6 fw-medium">Add Concept Note <span class="text-danger">*</span></label>
			<label class="d-block form-text text-secondary fs-7 m-0">Write in 50-75 words (this text will be used in pitch to journalists)</label>
		</div>
		<div class="col-md-8">
			<textarea id="inputConceptNote" class="form-control @error('conceptNote') is-invalid @enderror" wire:model="conceptNote" wire:keydown.debounce="characterCount" rows="6"></textarea>
			@error('conceptNote')<div class="invalid-feedback">{{ $message }}</div>@enderror
			<div id="conceptNoteHelp" class="form-text {{ $conceptNoteLength < 0 ? 'text-danger' : '' }}">{{ $conceptNoteLength }} characters left</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<label for="inputPressReleaseWrite" class="col-form-label text-dark fs-6 fw-medium">Write Press Release <span class="text-danger">*</span></label>
			<label class="d-block form-text text-secondary fs-7 m-0">Add the text in 300-500 words</label>
		</div>
		<div class="col-md-8">
			{{-- <input id="inputPressReleaseWrite" type="hidden" name="pressReleaseWrite" value="{{ $pressReleaseWrite }}">
  			<trix-editor input="inputPressReleaseWrite" class="trix-content"></trix-editor> --}}
			<textarea id="" class="form-control @error('pressReleaseWrite') is-invalid @enderror" wire:model="pressReleaseWrite" rows="8"></textarea>
			@error('pressReleaseWrite')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
						<div class="col-12" x-data="fileUpload('pressReleaseFile')">
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
									<label for="inputPressReleaseFile"><span class="text-purple-700 fw-semibold cursor-pointer">Click to upload</span></label> or drag and drop
								</p>
								<input type="file" id="inputPressReleaseFile" class="d-none" accept="application/pdf,application/doc,application/docs" @change="handleFileSelect">
								@if($pressReleaseFile)
									<ul class="mt-3 list-disc">
										<li>
											{{ $pressReleaseFile->getClientOriginalName() }}
											<button type="button" class="btn btn-link text-danger text-decoration-none" @click="removeUpload('{{ $pressReleaseFile->getFilename() }}')">X</button>
										</li>
									</ul>
								@endif
								<div x-show="isUploading" style="display: none;">
									<div class="progress">
										<div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" :style="`width: ${progress}%;`"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@error('pressReleaseFile')<div class="error">{{ $message }}</div>@enderror
			<div class="input-group">
				<span class="input-group-text bg-white" id="basic-addon1">http://</span>
				<input type="text" class="form-control @error('pressReleaseLink') is-invalid @enderror" wire:model="pressReleaseLink" placeholder="Insert drive link" aria-describedby="basic-addon1">
				@error('pressReleaseLink')<div class="invalid-feedback">{{ $message }}</div>@enderror
			</div>
		</div>
	</div>
	<hr class="border-gray-300">
	<div class="row">
		<div class="col-md-4">
			<label for="inputText" class="col-form-label text-dark fs-6 fw-medium">Upload Photographs</label>
			<label class="d-block form-text text-secondary fs-7 m-0">Choose the best high-resolution images</label>
		</div>
		<div class="col-md-8">
			<div class="card mb-2">
				<div class="card-body bg-white rounded-3 border border-light">
					<div class="row align-items-center">
						<div class="col-12" x-data="fileUpload('photographsFiles')">
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
									<label for="inputPhotographsFiles"><span class="text-purple-700 fw-semibold cursor-pointer">Click to upload</span></label> or drag and drop
								</p>
								<input type="file" id="inputPhotographsFiles" class="d-none" accept="image/svg,image/png,image/jpg,image/gif" @change="handleFilesSelect" multiple>
								@if(count($photographsFiles) > 0)
									<ul class="mt-3 list-disc">
										@foreach ($photographsFiles as $photographsFile)
										<li>
											{{ $photographsFile->getClientOriginalName() }}
											<button type="button" class="btn btn-link text-danger text-decoration-none" @click="removeUpload('{{ $photographsFile->getFilename() }}')">X</button>
										</li>
										@endforeach
									</ul>
								@endif
								<div x-show="isUploading" style="display: none;">
									<div class="progress">
										<div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" :style="`width: ${progress}%;`"></div>
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
			@error('photographsFiles')<div class="error">{{ $message }}</div>@enderror
			<div class="input-group">
				<span class="input-group-text bg-white" id="basic-addon1">http://</span>
				<input type="text" class="form-control @error('photographsLink') is-invalid @enderror" wire:model="photographsLink" placeholder="Insert drive link" aria-describedby="basic-addon1">
				@error('photographsLink')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
			<select id="selectMediaContact" class="form-select @error('mediaContact') is-invalid @enderror" wire:model="mediaContact">
				<option value="">Select Media Contact</option>
				@foreach ($mediaContacts as $mediaContact)
					<option value="{{ $mediaContact->id }}">{{ $mediaContact->user->name }}</option>
				@endforeach
			</select>
			@error('mediaContact')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<label for="selectMediaKitAccess" class="col-form-label text-dark fs-6 fw-medium">Media Kit Access <span class="text-danger">*</span></label>
			<label class="d-block form-text text-secondary fs-7 m-0">Set level of access for journalists</label>
		</div>
		<div class="col-md-8">
			<select id="selectMediaKitAccess" class="form-select @error('mediaKitAccess') is-invalid @enderror" wire:model="mediaKitAccess">
				<option value="">Select Media Kit Access</option>
				@foreach ($projectAccess as $mediaKitAccess)
					<option value="{{ $mediaKitAccess->id }}">{{ $mediaKitAccess->name }}</option>
				@endforeach
			</select>
			@error('mediaKitAccess')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<hr class="border-gray-300">
	<div class="text-end">
		<button class="btn btn-white fs-6 fw-semibold" type="button">Preview</button>
		<button class="btn btn-primary fs-6 fw-semibold" type="submit">
			Submit Press Release <x-users.spinners.white-btn wire:target="add" />
		</button>
	</div>
	<script>
		function fileUpload(element) {
			return {
				isDropping: false,
				isUploading: false,
				progress: 0,
				handleFileSelect(event) {
					if (event.target.files.length) {
						//console.log(event.target);
						console.log('uploading');
						this.uploadFile(event.target.files[0])
					}
				},
				handleFileDrop(event) {
					if (event.dataTransfer.files.length > 0) {
						console.log('dropping&uploading');
						this.uploadFile(event.dataTransfer.files[0])
					}
				},
				uploadFile(file) {
					const $this = this
					this.isUploading = true
					@this.upload(element, file,
						function (success) {  //upload was a success and was finished
							$this.isUploading = false
							$this.progress = 0
						},
						function(error) {  //an error occured
							console.log('error', error)
						},
						function (event) {  //upload progress was made
							$this.progress = event.detail.progress
						}
					)
				},
				handleFilesSelect(event) {
					if (event.target.files.length) {
						this.uploadFiles(event.target.files)
					}
				},
				handleFilesDrop(event) {
					if (event.dataTransfer.files.length > 0) {
						this.uploadFiles(event.dataTransfer.files)
					}
				},
				uploadFiles(files) {
					const $this = this
					this.isUploading = true
					@this.uploadMultiple(element, files,
						function (success) {  //upload was a success and was finished
							$this.isUploading = false
							$this.progress = 0
						},
						function(error) {  //an error occured
							console.log('error', error)
						},
						function (event) {  //upload progress was made
							$this.progress = event.detail.progress
						}
					)
				},
				removeUpload(filename) {
					@this.removeUpload(element, filename)
				},
			};
		}

		/* const trixEditor = document.getElementById('inputPressReleaseWrite');
		addEventListener("trix-blur", (event)=>{
			@this.set('pressReleaseWrite', trixEditor.getAttribute('value'));
		})

		const trixEditorElement = document.querySelector("trix-editor") */
	</script>
</form>
