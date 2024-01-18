<form wire:submit="add" class="pt-4">
	<div class="row">
		<div class="col-md-4">
			<label for="inputText" class="col-form-label text-dark fs-6 fw-medium">Cover Image <span class="text-danger">*</span></label>
			<label class="d-block form-text text-secondary fs-7 m-0">This will be displayed on your media kit.</label>
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-body bg-white rounded-3 border border-light">
					<div class="row align-items-center">
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
								<input type="file" id="inputCoverImage" class="d-none" @change="handleFileSelect">
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
		<label for="inputArticleTitle" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Article Title <span class="text-danger">*</span></label>
		<div class="col-md-8">
			<input type="text" id="inputArticleTitle" class="form-control @error('articleTitle') is-invalid @enderror" wire:model="articleTitle">
			@error('articleTitle')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="row mb-3">
		<label for="inputTextCredits" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Text Credits <span class="text-danger">*</span></label>
		<div class="col-md-8">
			<input type="text" id="inputTextCredits" class="form-control @error('textCredits') is-invalid @enderror" wire:model="textCredits">
			@error('textCredits')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
	<div class="row">
		<div class="col-md-4">
			<label for="inputPreviewText" class="col-form-label text-dark fs-6 fw-medium">Add Preview Text <span class="text-danger">*</span></label>
			<label class="d-block form-text text-secondary fs-7 m-0">Write in 50-75 words (this text will be used in pitch to journalists)</label>
		</div>
		<div class="col-md-8">
			<textarea id="inputPreviewText" class="form-control @error('previewText') is-invalid @enderror" wire:model="previewText" wire:keydown.debounce="characterCount" rows="6"></textarea>
			@error('previewText')<div class="invalid-feedback">{{ $message }}</div>@enderror
			<div id="previewTextHelp" class="form-text {{ $previewTextLength < 0 ? 'text-danger' : '' }}">{{ $previewTextLength }} characters left</div>
		</div>
	</div>
	<hr class="border-gray-300">
	<div class="row">
		<div class="col-md-4">
			<label for="inputArticleWrite" class="col-form-label text-dark fs-6 fw-medium">Upload Article <span class="text-danger">*</span></label>
			<label class="d-block form-text text-secondary fs-7 m-0">Add the text in 500-1000 words</label>
		</div>
		<div class="col-md-8">
			<div class="card mb-2">
				<div class="card-body bg-white rounded-3 border border-light">
					<div class="row align-items-center">
						<div class="col-12" x-data="fileUpload('articleFile')">
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
									<label for="inputArticleFile"><span class="text-purple-700 fw-semibold cursor-pointer">Click to upload</span></label> or drag and drop
								</p>
								<input type="file" id="inputArticleFile" class="d-none" @change="handleFileSelect">
								@if($articleFile)
									<ul class="mt-3 list-disc">
										<li>
											{{ $articleFile->getClientOriginalName() }}
											<button type="button" class="btn btn-link text-danger text-decoration-none" @click="removeUpload('{{ $articleFile->getFilename() }}')">X</button>
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
			@error('articleFile')<div class="error">{{ $message }}</div>@enderror
			<div class="input-group mb-3">
				<span class="input-group-text bg-white" id="articleLinkAddon">http://</span>
				<input type="text" class="form-control @error('articleLink') is-invalid @enderror" wire:model="articleLink" placeholder="Insert drive link" aria-describedby="articleLinkAddon">
				@error('articleLink')<div class="invalid-feedback">{{ $message }}</div>@enderror
			</div>
			<textarea id="inputArticleWrite" class="form-control @error('articleWrite') is-invalid @enderror" wire:model="articleWrite" rows="8"></textarea>
			@error('articleWrite')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<hr class="border-gray-300">
	<div class="row">
		<div class="col-md-4">
			<label for="inputCompanyProfileFile" class="col-form-label text-dark fs-6 fw-medium">Upload Company Profile</label>
			<label class="d-block form-text text-secondary fs-7 m-0">Add the file as Word document/PDF</label>
		</div>
		<div class="col-md-8">
			<div class="card mb-2">
				<div class="card-body bg-white rounded-3 border border-light">
					<div class="row align-items-center">
						<div class="col-12" x-data="fileUpload('companyProfileFile')">
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
									<label for="inputCompanyProfileFile"><span class="text-purple-700 fw-semibold cursor-pointer">Click to upload</span></label> or drag and drop
								</p>
								<input type="file" id="inputCompanyProfileFile" class="d-none" @change="handleFileSelect">
								@if($companyProfileFile)
									<ul class="mt-3 list-disc">
										<li>
											{{ $companyProfileFile->getClientOriginalName() }}
											<button type="button" class="btn btn-link text-danger text-decoration-none" @click="removeUpload('{{ $companyProfileFile->getFilename() }}')">X</button>
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
			<div class="input-group">
				<span class="input-group-text bg-white" id="companyProfileLinkAddon">http://</span>
				<input type="text" class="form-control @error('companyProfileLink') is-invalid @enderror" wire:model="companyProfileLink" placeholder="Insert drive link" aria-describedby="companyProfileLinkAddon">
				@error('companyProfileLink')<div class="invalid-feedback">{{ $message }}</div>@enderror
			</div>
		</div>
	</div>
	<hr class="border-gray-300">
	<div class="row">
		<div class="col-md-4">
			<label for="inputImagesFiles" class="col-form-label text-dark fs-6 fw-medium">Upload Images</label>
			<label class="d-block form-text text-secondary fs-7 m-0">Choose the best high-resolution images</label>
		</div>
		<div class="col-md-8">
			<div class="card mb-2">
				<div class="card-body bg-white rounded-3 border border-light">
					<div class="row align-items-center">
						<div class="col-12" x-data="fileUpload('imagesFiles')">
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
									<label for="inputImagesFiles"><span class="text-purple-700 fw-semibold cursor-pointer">Click to upload</span></label> or drag and drop
								</p>
								<input type="file" id="inputImagesFiles" class="d-none" @change="handleFilesSelect" multiple>
								@if(count($imagesFiles) > 0)
									<ul class="mt-3 list-disc">
										@foreach ($imagesFiles as $imagesFile)
										<li>
											{{ $imagesFile->getClientOriginalName() }}
											<button type="button" class="btn btn-link text-danger text-decoration-none" @click="removeUpload('{{ $imagesFile->getFilename() }}')">X</button>
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
			@error('imagesFiles')<div class="error">{{ $message }}</div>@enderror
			<div class="input-group">
				<span class="input-group-text bg-white" id="imagesLinkAddon">http://</span>
				<input type="text" class="form-control @error('imagesLink') is-invalid @enderror" wire:model="imagesLink" placeholder="Insert drive link" aria-describedby="imagesLinkAddon">
				@error('imagesLink')<div class="invalid-feedback">{{ $message }}</div>@enderror
			</div>
		</div>
	</div>
	<hr class="border-gray-300">
	<div class="row mb-3">
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
										{{-- @keydown.backspace="if (newTag.trim() === '') tags.pop()" --}}
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
			Submit Article <x-users.spinners.white-btn wire:target="add" />
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
	</script>
</form>