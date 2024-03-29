<form wire:submit="add" class="pt-4">
	@include('users.includes.architect.add-story.cover-image-field')
	<hr class="border-gray-300">
	<div class="row mb-3">
		<label for="inputArticleTitle" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Article Title <span class="text-danger">*</span></label>
		<div class="col-md-8">
			<input type="text" id="inputArticleTitle" class="form-control @error('form.articleTitle') is-invalid @enderror" wire:model="form.articleTitle">
			@error('form.articleTitle')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="row mb-3">
		<label for="inputTextCredits" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Text Credits <span class="text-danger">*</span></label>
		<div class="col-md-8">
			<input type="text" id="inputTextCredits" class="form-control @error('form.textCredits') is-invalid @enderror" wire:model="form.textCredits">
			@error('form.textCredits')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
	<div class="row">
		<div class="col-md-4">
			<label for="inputPreviewText" class="col-form-label text-dark fs-6 fw-medium">Add Preview Text <span class="text-danger">*</span></label>
			<label class="d-block form-text text-secondary fs-7 m-0">Write in 50-75 words (this text will be used in pitch to journalists)</label>
		</div>
		<div class="col-md-8">
			<textarea id="inputPreviewText" class="form-control @error('form.previewText') is-invalid @enderror" wire:model="form.previewText" wire:keydown.debounce.1000ms="characterCount" rows="6"></textarea>
			@error('form.previewText')<div class="invalid-feedback">{{ $message }}</div>@enderror
			<div id="previewTextHelp" class="form-text {{ $form->previewTextLength < 0 ? 'text-danger' : '' }}">{{ $form->previewTextLength }} characters left</div>
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
						<div class="col-12" x-data="fileUpload('form.articleFile')">
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
									<label for="articleFile"><span class="text-purple-700 fw-semibold cursor-pointer">Click to upload</span></label> or drag and drop
								</p>
								<input type="file" id="articleFile" class="d-none" @change="handleFileSelect">
								@if($form->articleFile)
									<ul class="mt-3 list-disc">
										@if(method_exists($form->articleFile, 'getClientOriginalName'))
											<li>
												{{ $form->articleFile->getClientOriginalName() }}
												<button type="button" class="btn btn-link text-danger text-decoration-none" @click="removeUpload('{{ $form->articleFile->getFilename() }}')">X</button>
											</li>
										@else
											<li style="list-style: none;">
												<a href="{{ Storage::url($form->articleFile) }}" class="text-purple-700">See Document</a>
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
			@error('form.articleFile')<div class="error">{{ $message }}</div>@enderror
			<div class="input-group mb-3">
				<span class="input-group-text bg-white" id="articleLinkAddon">http://</span>
				<input type="text" class="form-control @error('form.articleLink') is-invalid @enderror" wire:model="form.articleLink" placeholder="Insert drive link" aria-describedby="articleLinkAddon">
				@error('form.articleLink')<div class="invalid-feedback">{{ $message }}</div>@enderror
			</div>
			{{-- <textarea id="inputArticleWrite" class="form-control @error('form.articleWrite') is-invalid @enderror" wire:model="form.articleWrite" rows="8"></textarea> --}}
			<trix-editor input="inputArticleWrite" x-on:trix-change="$wire.form.articleWrite = $event.target.value"></trix-editor>
			<input id="inputArticleWrite" type="hidden" wire:model="form.articleWrite">
			@error('form.articleWrite')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
						<div class="col-12" x-data="fileUpload('form.companyProfileFile')">
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
									<label for="companyProfileFile"><span class="text-purple-700 fw-semibold cursor-pointer">Click to upload</span></label> or drag and drop
								</p>
								<input type="file" id="companyProfileFile" class="d-none" @change="handleFileSelect">
								@if($form->companyProfileFile)
									<ul class="mt-3 list-disc">
										@if(method_exists($form->companyProfileFile, 'getClientOriginalName'))
											<li>
												{{ $form->companyProfileFile->getClientOriginalName() }}
												<button type="button" class="btn btn-link text-danger text-decoration-none" @click="removeUpload('{{ $form->companyProfileFile->getFilename() }}')">X</button>
											</li>
										@else
											<li style="list-style: none;">
												<a href="{{ Storage::url($form->companyProfileFile) }}" class="text-purple-700">See Document</a>
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
			<div class="input-group">
				<span class="input-group-text bg-white" id="companyProfileLinkAddon">http://</span>
				<input type="text" class="form-control @error('form.companyProfileLink') is-invalid @enderror" wire:model="form.companyProfileLink" placeholder="Insert drive link" aria-describedby="companyProfileLinkAddon">
				@error('form.companyProfileLink')<div class="invalid-feedback">{{ $message }}</div>@enderror
			</div>
		</div>
	</div>
	<hr class="border-gray-300">
	<div class="row">
		<div class="col-md-4">
			<label for="inputImagesFiles" class="col-form-label text-dark fs-6 fw-medium">Upload Images</label>
			<label class="d-block form-text text-secondary fs-7 m-0">Choose the best images (maximum upload limit 4MB each image)</label>
		</div>
		<div class="col-md-8">
			<div class="card mb-2">
				<div class="card-body bg-white rounded-3 border border-light">
					<div class="row align-items-center">
						<div class="col-12" x-data="fileUpload('form.imagesFiles')">
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
									<label for="imagesFiles"><span class="text-purple-700 fw-semibold cursor-pointer">Click to upload</span></label> or drag and drop
								</p>
								<input type="file" id="imagesFiles" class="d-none" @change="handleFilesSelect" multiple>
								@if(count($form->imagesFiles) > 0 || count($form->oldImagesFiles) > 0)
									<ul class="d-flex flex-wrap mt-3" style="list-style: none;">
										@foreach ($form->oldImagesFiles as $imagesFile)
											<li class="position-relative p-2">
												<img class="img-fluid img-thumbnail" width="150" src="{{ Storage::url($imagesFile->image_path) }}" alt="">
												<button type="button" class="btn btn-sm btn-secondary rounded-circle text-decoration-none position-absolute end-0 top-0" wire:click="removeImage('{{ $imagesFile->id }}')">X</button>
											</li>
										@endforeach
										@foreach ($form->imagesFiles as $key => $imagesFile)
											@if(method_exists($imagesFile, 'temporaryUrl'))
												<li class="position-relative p-2">
													<img class="img-fluid img-thumbnail" width="150" src="{{ $imagesFile->temporaryUrl() }}" alt="">
													<button type="button" class="btn btn-sm btn-secondary rounded-circle text-decoration-none position-absolute end-0 top-0" @click="removeUpload('{{ $imagesFile->getFilename() }}')">X</button>
												</li>
											@else
												<li class="position-relative p-2">
													<img class="img-fluid img-thumbnail" width="150" src="{{ Storage::url($imagesFile) }}" alt="">
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
					</div>
				</div>
			</div>
			@error('form.imagesFiles')<div class="error">{{ $message }}</div>@enderror
			<div class="input-group">
				<span class="input-group-text bg-white" id="imagesLinkAddon">http://</span>
				<input type="text" class="form-control @error('form.imagesLink') is-invalid @enderror" wire:model="form.imagesLink" placeholder="Insert drive link" aria-describedby="imagesLinkAddon">
				@error('form.imagesLink')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
			{{ isset($edit) ? 'Edit Article' : 'Submit Article' }} <x-users.spinners.white-btn wire:target="add" />
		</button>
		{{-- <button class="btn btn-white fs-6 fw-semibold" type="button">Preview</button>
		<button class="btn btn-primary fs-6 fw-semibold" type="submit">
			Submit Article <x-users.spinners.white-btn wire:target="add" />
		</button> --}}
	</div>
	@include('users.includes.common.file-upload-script', ['width' => 800, 'height' => 400])
	<script>
		const editor = document.querySelector("trix-editor");
		editor.editor.insertHTML('{!! $form->articleWrite !!}');
	</script>
</form>
