<form wire:submit="add" class="pt-4">
	@include('users.includes.architect.add-story.cover-image-field', ['subLabel' => 'This will be displayed on your media kit.<br>Kindly add a relevant cover image. For example, image of project/ product/ team/ brand logo/ founder/ event etc.'])
	<hr class="border-gray-300">
	<div class="mb-3 row">
		<label for="inputArticleTitle" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Article Title <span class="text-danger">*</span></label>
		<div class="col-md-8">
			<input type="text" id="inputArticleTitle" class="form-control @error('form.articleTitle') is-invalid @enderror" wire:model="form.articleTitle">
			@error('form.articleTitle')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="mb-3 row">
		<label for="inputTextCredits" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Text Credits <span class="text-danger">*</span></label>
		<div class="col-md-8">
			<input type="text" id="inputTextCredits" class="form-control @error('form.textCredits') is-invalid @enderror" wire:model="form.textCredits">
			@error('form.textCredits')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="mb-3 row">
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
			<label class="m-0 d-block form-text text-secondary fs-7">Write in 50-75 words (this text will be used in pitch to journalists)</label>
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
			<label class="m-0 d-block form-text text-secondary fs-7">Add the text in 500-1000 words</label>
		</div>
		<div class="col-md-8">
			<div class="mb-2 card">
				<div class="bg-white border card-body rounded-3 border-light">
					<div class="row align-items-center">
						<div class="col-12" x-data="fileUpload('form.articleFile')">
							<div
								x-on:drop="isDropping = false"
								x-on:drop.prevent="handleFileDrop($event)"
								x-on:dragover.prevent="isDropping = true"
								x-on:dragleave.prevent="isDropping = false"
							>
								<div class="top-0 bottom-0 z-30 flex opacity-75 position-absolute start-0 end-0 justify-content-center align-items-center bg-primary rounded-2" x-show="isDropping" style="display: none;">
									<span class="text-white fs-4">Release file to upload!</span>
								</div>
								<div class="d-flex justify-content-center align-items-center">
									<div class="text-gray-600 upload-icon rounded-circle fs-5">
										<i class="bi bi-cloud-upload"></i>
									</div>
								</div>
								<p class="py-2 m-0 text-center card-text text-secondary fs-6">
									<label for="articleFile"><span class="text-purple-700 cursor-pointer fw-semibold">Click to upload</span></label> or drag and drop
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
			<div class="mb-3">
				<input type="text" class="form-control @error('form.articleLink') is-invalid @enderror" wire:model="form.articleLink" placeholder="Insert drive link" aria-describedby="articleLinkAddon">
				@error('form.articleLink')<div class="invalid-feedback">{{ $message }}</div>@enderror
			</div>
			{{-- <textarea id="inputArticleWrite" class="form-control @error('form.articleWrite') is-invalid @enderror" wire:model="form.articleWrite" rows="8"></textarea> --}}
			<div wire:ignore>
				<trix-editor input="inputArticleWrite" x-on:trix-change="$wire.form.articleWrite = $event.target.value"></trix-editor>
				<input id="inputArticleWrite" type="hidden" wire:model="form.articleWrite">
			</div>
			@error('form.articleWrite')<div class="error">{{ $message }}</div>@enderror
		</div>
	</div>
	<hr class="border-gray-300">
	<div class="row">
		<div class="col-md-4">
			<label for="inputCompanyProfileFile" class="col-form-label text-dark fs-6 fw-medium">Upload Company Profile</label>
			<label class="m-0 d-block form-text text-secondary fs-7">Add the file as Word document/PDF</label>
		</div>
		<div class="col-md-8">
			<div class="mb-2 card">
				<div class="bg-white border card-body rounded-3 border-light">
					<div class="row align-items-center">
						<div class="col-12" x-data="fileUpload('form.companyProfileFile')">
							<div
								x-on:drop="isDropping = false"
								x-on:drop.prevent="handleFileDrop($event)"
								x-on:dragover.prevent="isDropping = true"
								x-on:dragleave.prevent="isDropping = false"
							>
								<div class="top-0 bottom-0 z-30 flex opacity-75 position-absolute start-0 end-0 justify-content-center align-items-center bg-primary rounded-2" x-show="isDropping" style="display: none;">
									<span class="text-white fs-4">Release file to upload!</span>
								</div>
								<div class="d-flex justify-content-center align-items-center">
									<div class="text-gray-600 upload-icon rounded-circle fs-5">
										<i class="bi bi-cloud-upload"></i>
									</div>
								</div>
								<p class="py-2 m-0 text-center card-text text-secondary fs-6">
									<label for="companyProfileFile"><span class="text-purple-700 cursor-pointer fw-semibold">Click to upload</span></label> or drag and drop
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
			<div class="">
				<input type="text" class="form-control @error('form.companyProfileLink') is-invalid @enderror" wire:model="form.companyProfileLink" placeholder="Insert drive link" aria-describedby="companyProfileLinkAddon">
				@error('form.companyProfileLink')<div class="invalid-feedback">{{ $message }}</div>@enderror
			</div>
		</div>
	</div>
	<hr class="border-gray-300">
	<div class="row">
		<div class="col-md-4">
			<label for="inputImagesFiles" class="col-form-label text-dark fs-6 fw-medium">Upload Images</label>
			<label class="m-0 d-block form-text text-secondary fs-7">Choose the best images (maximum upload limit 4MB each image)</label>
		</div>
		<div class="col-md-8">
			<div class="mb-2 card">
				<div class="bg-white border card-body rounded-3 border-light">
					<div class="row align-items-center">
						<div class="col-12" x-data="fileUpload('form.imagesFiles')">
							<div
								x-on:drop="isDropping = false"
								x-on:drop.prevent="handleFilesDrop($event)"
								x-on:dragover.prevent="isDropping = true"
								x-on:dragleave.prevent="isDropping = false"
							>
								<div class="top-0 bottom-0 z-30 flex opacity-75 position-absolute start-0 end-0 justify-content-center align-items-center bg-primary rounded-2" x-show="isDropping" style="display: none;">
									<span class="text-white fs-4">Release file to upload!</span>
								</div>
								<div class="d-flex justify-content-center align-items-center">
									<div class="text-gray-600 upload-icon rounded-circle fs-5">
										<i class="bi bi-cloud-upload"></i>
									</div>
								</div>
								<p class="py-2 m-0 text-center card-text text-secondary fs-6">
									<label for="imagesFiles"><span class="text-purple-700 cursor-pointer fw-semibold">Click to upload</span></label> or drag and drop
								</p>
								<input type="file" id="imagesFiles" class="d-none" @change="handleFilesSelect" multiple>
								@if(count($form->imagesFiles) > 0 || count($form->oldImagesFiles) > 0)
									<ul class="flex-wrap mt-3 d-flex" style="list-style: none;">
										@foreach ($form->oldImagesFiles as $imagesFile)
											<li class="p-2 position-relative">
												<img class="img-fluid img-thumbnail" width="150" src="{{ Storage::url($imagesFile->image_path) }}" alt="">
												<button type="button" class="top-0 btn btn-sm btn-secondary rounded-circle text-decoration-none position-absolute end-0" wire:click="removeImage('{{ $imagesFile->id }}')">X</button>
											</li>
										@endforeach
										@foreach ($form->imagesFiles as $key => $imagesFile)
											@if(method_exists($imagesFile, 'temporaryUrl'))
												<li class="p-2 position-relative" wire:key="{{ $key }}">
													<img class="img-fluid img-thumbnail" width="150" src="{{ $imagesFile->temporaryUrl() }}" alt="">
													<button type="button" class="top-0 btn btn-sm btn-secondary rounded-circle text-decoration-none position-absolute end-0" @click="removeUpload('{{ $imagesFile->getFilename() }}')">X</button>
												</li>
											@else
												<li class="p-2 position-relative" wire:key="{{ $key }}">
													<img class="img-fluid img-thumbnail" width="150" src="{{ Storage::url($imagesFile) }}" alt="">
													<button type="button" class="top-0 btn btn-sm btn-secondary rounded-circle text-decoration-none position-absolute end-0" wire:click="removeImage({{ $key }})">X</button>
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
			<div class="">
				<input type="text" class="form-control @error('form.imagesLink') is-invalid @enderror" wire:model="form.imagesLink" placeholder="Insert drive link" aria-describedby="imagesLinkAddon">
				@error('form.imagesLink')<div class="invalid-feedback">{{ $message }}</div>@enderror
			</div>
		</div>
	</div>
	<hr class="border-gray-300">
	<div class="mb-3 row">
		<label for="inputTags" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Tags</label>
		<div class="col-md-8">
			@include('users.includes.input-tags')
		</div>
	</div>
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
			<label class="m-0 d-block form-text text-secondary fs-7">Set level of access for journalists</label>
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
		<button class="btn btn-black fs-6 fw-semibold" type="button" data-bs-toggle="modal" data-bs-target="#deleteMediaKitModal">Delete</button>
		@empty($edit)
			<button class="btn btn-white fs-6 fw-semibold" type="button" wire:click="draft">
				Save as Draft <x-users.spinners.primary-btn wire:target="draft" />
			</button>
			<button class="btn btn-white fs-6 fw-semibold" type="button" wire:click="preview">
				Preview <x-users.spinners.primary-btn wire:target="preview" />
			</button>
		@endempty
		<button class="btn btn-primary fs-6 fw-semibold" type="submit">
			{{ isset($edit) ? 'Save Article' : 'Submit Article' }} <x-users.spinners.white-btn wire:target="add" />
		</button>
	</div>
	@include('users.includes.common.file-upload-script', ['width' => 800, 'height' => 400])
	@script
		<script>
			let editor = document.querySelector("trix-editor");
			editor.editor.insertHTML('{!! addslashes($form->articleWrite) !!}');
		</script>
	@endscript
	{{-- <script>
		const editor = document.querySelector("trix-editor");
		editor.editor.insertHTML('{!! $form->articleWrite !!}');
	</script> --}}
	@include('users.includes.architect.add-story.modal-delete-media-kit')
</form>
