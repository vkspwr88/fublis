@include('users.includes.architect.add-story.press-release-form', ['edit' => true])

{{-- <form wire:submit="edit" class="pt-4">
	<div class="row">
		<div class="col-md-4">
			<label for="inputText" class="col-form-label text-dark fs-6 fw-medium">Cover Image</label>
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
									<label for="inputCoverImage"><span class="text-purple-700 fw-semibold">Click to upload</span></label> or drag and drop
								</p>
								<input type="file" id="inputCoverImage" class="d-none" @change="handleFileSelect">
								<p class="card-text text-center text-secondary fs-6 m-0 py-2">SVG, PNG, JPG or GIF (max. 800x400px)</p>
								@if($coverImage)
									<ul class="mt-3 list-disc">
										<li>
											@if(method_exists($coverImage, 'getClientOriginalName'))
												{{ $coverImage->getClientOriginalName() }}
												<button type="button" class="btn btn-link text-danger text-decoration-none" @click="removeUpload('{{ $coverImage->getFilename() }}')">X</button>
											@else
												{{ filterFileName($coverImage) }}
											@endif
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
		<label for="inputPressReleaseTitle" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Press Release Title</label>
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
		<label for="selectCategory" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Category</label>
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
			<label for="inputConceptNote" class="col-form-label text-dark fs-6 fw-medium">Add Concept Note</label>
			<label class="d-block form-text text-secondary fs-7 m-0">Write in 50-75 words (this text will be used in pitch to journalists)</label>
		</div>
		<div class="col-md-8">
			<textarea id="inputConceptNote" class="form-control @error('conceptNote') is-invalid @enderror" wire:model="conceptNote" rows="6"></textarea>
			@error('conceptNote')<div class="invalid-feedback">{{ $message }}</div>@enderror
			<div id="conceptNoteHelp" class="form-text">275 characters left</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<label for="inputPressReleaseWrite" class="col-form-label text-dark fs-6 fw-medium">Write Press Release</label>
			<label class="d-block form-text text-secondary fs-7 m-0">Add the text in 300-500 words</label>
		</div>
		<div class="col-md-8">
			<textarea id="inputPressReleaseWrite" class="form-control @error('pressReleaseWrite') is-invalid @enderror" wire:model="pressReleaseWrite" rows="8"></textarea>
			@error('pressReleaseWrite')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<hr class="border-gray-300">
	<div class="row">
		<div class="col-md-4">
			<label for="" class="col-form-label text-dark fs-6 fw-medium">Upload Press Release</label>
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
									<label for="inputPressReleaseFile"><span class="text-purple-700 fw-semibold">Click to upload</span></label> or drag and drop
								</p>
								<input type="file" id="inputPressReleaseFile" class="d-none" @change="handleFileSelect">
								@if($pressReleaseFile)
									<ul class="mt-3 list-disc">
										<li>
											@if(method_exists($pressReleaseFile, 'getClientOriginalName'))
												{{ $pressReleaseFile->getClientOriginalName() }}
												<button type="button" class="btn btn-link text-danger text-decoration-none" @click="removeUpload('{{ $pressReleaseFile->getFilename() }}')">X</button>
											@else
												{{ filterFileName($pressReleaseFile) }}
											@endif
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
									<label for="inputPhotographsFiles"><span class="text-purple-700 fw-semibold">Click to upload</span></label> or drag and drop
								</p>
								<input type="file" id="inputPhotographsFiles" class="d-none" @change="handleFilesSelect" multiple>
								@if(count($photographsFiles) > 0)
									<ul class="mt-3 list-disc">
										@foreach ($photographsFiles as $photographsFile)
										<li>
											@if(method_exists($photographsFile, 'getClientOriginalName'))
												{{ $photographsFile->getClientOriginalName() }}
												<button type="button" class="btn btn-link text-danger text-decoration-none" @click="removeUpload('{{ $photographsFile->getFilename() }}')">X</button>
											@else
												{{ filterFileName($photographsFile) }}
											@endif
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
	<div class="row">
		<label for="inputTags" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Tags</label>
		<div class="col-md-8">
			<div x-data="{tags: @entangle('tags'), newTag: '' }">
				<template x-for="tag in tags">
					<input type="hidden" :value="tag" name="tags">
			 	</template>
				<div class="max-w-sm w-full ">
					<div class="tags-input">
						<input class="form-control @error('tags') is-invalid @enderror"
										@keydown.enter.prevent="if (newTag.trim() !== '') tags.push(newTag.trim().toLowerCase()); newTag = ''"
										@keydown.period.prevent="if (newTag.trim() !== '') tags.push(newTag.trim().toLowerCase()); newTag = ''"
										@keydown.space.prevent="if (newTag.trim() !== '') tags.push(newTag.trim().toLowerCase()); newTag = ''"
										{{-- @keydown.backspace="if (newTag.trim() === '') tags.pop()" --
										x-model="newTag"
						>
						<div class="mt-2">
							<template x-for="tag in tags" :key="tag">
								<span class="tags-input-tag badge rounded-pill bg-primary me-1">
									<span x-text="tag" class="fs-6 align-middle"></span>
									<button type="button" class="tags-input-remove btn-close btn-close-white align-middle" @click="tags = tags.filter(i => i !== tag)"></button>
								</span>
							</template>
						</div>

					</div>
			 	</div>
			</div>
			<div id="tagsHelpBlock" class="form-text">Press enter, dot or space to add tags.</div>
			@error('tags')<div class="error">{{ $message }}</div>@enderror
		</div>
	</div>
	<hr class="border-gray-300">
	<div class="text-end">
		<button class="btn btn-white fs-6 fw-semibold" type="button">Preview</button>
		<button class="btn btn-primary fs-6 fw-semibold" type="submit">Save Press Release</button>
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
	</script>
</form> --}}
