<form wire:submit="add" class="pt-4">
	@include('users.includes.utilities.alerts.error')
	<div class="mb-3 row">
		<label for="inputProjectTitle" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Title <span class="text-danger">*</span></label>
		<div class="col-md-8">
			<input type="text" id="inputProjectTitle" class="form-control @error('form.projectTitle') is-invalid @enderror" wire:model="form.projectTitle">
			@error('form.projectTitle')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="row">
		<label for="selectCategory" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Category <span class="text-danger">*</span></label>
		<div class="col-md-8">
			<select id="selectCategory" class="form-select @error('form.category') is-invalid @enderror" wire:model.live="form.category">
				<option value="">Select Category</option>
				@foreach ($form->categories as $category)
					<option value="{{ $category->id }}">{{ $category->name }}</option>
				@endforeach
			</select>
			@error('form.category')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<hr class="border-gray-300">
	@if($form->showOtherFields)
		<div class="mb-3 row">
			<label for="inputSiteArea" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Site Area</label>
			<div class="col-md-8">
				<div class="input-group">
					<input type="text" id="inputSiteArea" class="form-control @error('form.siteArea') is-invalid @enderror" wire:model="form.siteArea">
					<select id="selectSiteArea" class="form-select @error('form.siteAreaUnit') is-invalid @enderror" wire:model="form.siteAreaUnit" style="max-width: 140px;">
						<option value="">Select</option>
						@foreach ($form->areas as $area)
							<option value="{{ $area->id }}">{{ $area->name }}</option>
						@endforeach
					</select>
					@error('form.siteArea')<div class="invalid-feedback">{{ $message }}</div>@enderror
					@error('form.siteAreaUnit')<div class="invalid-feedback">{{ $message }}</div>@enderror
				</div>
			</div>
		</div>
		<div class="mb-3 row">
			<label for="inputBuiltUpArea" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Built Up Area</label>
			<div class="col-md-8">
				<div class="input-group">
					<input type="text" id="inputBuiltUpArea" class="form-control @error('form.builtUpArea') is-invalid @enderror" wire:model="form.builtUpArea">
					<select id="selectBuiltUpArea" class="form-select @error('form.builtUpAreaUnit') is-invalid @enderror" wire:model="form.builtUpAreaUnit" style="max-width: 140px;">
						<option value="">Select</option>
						@foreach ($form->areas as $area)
							<option value="{{ $area->id }}">{{ $area->name }}</option>
						@endforeach
					</select>
					@error('form.builtUpArea')<div class="invalid-feedback">{{ $message }}</div>@enderror
					@error('form.builtUpAreaUnit')<div class="invalid-feedback">{{ $message }}</div>@enderror
				</div>
			</div>
		</div>
		<div class="mb-3 row">
			<label for="inputMaterials" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Materials</label>
			<div class="col-md-8">
				<textarea id="inputMaterials" class="form-control @error('form.materials') is-invalid @enderror" wire:model="form.materials" rows="6"></textarea>
				{{-- <input type="text" id="inputMaterials" class="form-control @error('form.materials') is-invalid @enderror" wire:model="form.materials"> --}}
				@error('form.materials')<div class="invalid-feedback">{{ $message }}</div>@enderror
			</div>
		</div>
		<div class="mb-3 row">
			<label for="selectBuildingTypology" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Building Typology</label>
			<div class="col-md-8">
				<select id="selectBuildingTypology" class="form-select @error('form.buildingTypology') is-invalid @enderror" wire:model.live="form.buildingTypology">
					<option value="">Select Building Typology</option>
					@foreach ($form->buildingTypologies as $buildingTypology)
						<option value="{{ $buildingTypology->id }}">{{ $buildingTypology->name }}</option>
					@endforeach
				</select>
				@error('form.buildingTypology')<div class="invalid-feedback">{{ $message }}</div>@enderror
			</div>
		</div>
		<div class="mb-3 row">
			<label for="selectBuildingUse" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Building Use</label>
			<div class="col-md-8">
				<select id="selectBuildingUse" class="form-select @error('form.buildingUse') is-invalid @enderror" wire:model="form.buildingUse">
					<option value="">Select Building Use</option>
					@foreach ($form->buildingUses as $buildingUse)
						<option value="{{ $buildingUse->id }}">{{ $buildingUse->name }}</option>
					@endforeach
				</select>
				@error('form.buildingUse')<div class="invalid-feedback">{{ $message }}</div>@enderror
			</div>
		</div>
	@endif
	{{-- <div class="mb-3 row">
		<label for="selectLocation" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Location</label>
		<div class="col-md-8">
			<select id="selectLocation" class="form-select @error('location') is-invalid @enderror" wire:model="location">
				<option value="">Select Location</option>
				@foreach ($locations as $location)
					<option value="{{ $location->id }}">{{ $location->name }}</option>
				@endforeach
			</select>
			@error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div> --}}
	<div class="mb-3 row">
		<label for="selectCountry" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Country <span class="text-danger">*</span></label>
		<div class="col-md-8">
			<select class="form-select @error('form.selectedCountry') is-invalid @enderror" id="selectCountry" wire:model.live="form.selectedCountry">
				<option value="0">Select Country</option>
				@foreach ($form->countries as $country)
				<option value="{{ $country->name }}">{{ str()->headline($country->name) }}</option>
				@endforeach
			</select>
			@error('form.selectedCountry')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="mb-3 row">
		<label for="selectState" class="col-md-4 col-form-label text-dark fs-6 fw-medium">State {{-- <span class="text-danger">*</span> --}}</label>
		<div class="col-md-8">
			<select class="form-select @error('form.selectedState') is-invalid @enderror" id="selectState" wire:model.live="form.selectedState">
				<option value="0">Select State</option>
				@foreach ($form->states as $state)
				<option value="{{ $state->id }}">{{ str()->headline($state->name) }}</option>
				@endforeach
			</select>
			@error('form.selectedState')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="mb-3 row">
		<label for="selectCity" class="col-md-4 col-form-label text-dark fs-6 fw-medium">City {{-- <span class="text-danger">*</span> --}}</label>
		<div class="col-md-8">
			<select class="form-select @error('form.selectedCity') is-invalid @enderror" id="selectCity" wire:model="form.selectedCity">
				<option value="0">Select City</option>
				@foreach ($form->cities as $city)
				<option value="{{ $city->id }}">{{ str()->headline($city->name) }}</option>
				@endforeach
			</select>
			@error('form.selectedCity')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="mb-3 row">
		<label for="selectStatus" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Status <span class="text-danger">*</span></label>
		<div class="col-md-8">
			<select id="selectStatus" class="form-select @error('form.status') is-invalid @enderror" wire:model="form.status">
				<option value="">Select Status</option>
				@foreach ($form->statuses as $status)
					<option value="{{ $status->id }}">{{ $status->name }}</option>
				@endforeach
			</select>
			@error('form.status')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="mb-3 row">
		<label for="inputImageCredits" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Image Credits</label>
		<div class="col-md-8">
			<textarea id="inputImageCredits" class="form-control @error('form.imageCredits') is-invalid @enderror" wire:model="form.imageCredits" rows="6"></textarea>
			{{-- <input type="text" id="inputImageCredits" class="form-control @error('form.imageCredits') is-invalid @enderror" wire:model="form.imageCredits"> --}}
			@error('form.imageCredits')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="mb-3 row">
		<label for="inputTextCredits" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Text Credits</label>
		<div class="col-md-8">
			<textarea id="inputTextCredits" class="form-control @error('form.textCredits') is-invalid @enderror" wire:model="form.textCredits" rows="6"></textarea>
			{{-- <input type="text" id="inputTextCredits" class="form-control @error('form.textCredits') is-invalid @enderror" wire:model="form.textCredits"> --}}
			@error('form.textCredits')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="mb-3 row">
		<label for="inputRenderCredits" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Render Credits</label>
		<div class="col-md-8">
			<textarea id="inputRenderCredits" class="form-control @error('form.renderCredits') is-invalid @enderror" wire:model="form.renderCredits" rows="6"></textarea>
			{{-- <input type="text" id="inputRenderCredits" class="form-control @error('form.renderCredits') is-invalid @enderror" wire:model="form.renderCredits"> --}}
			@error('form.renderCredits')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="mb-3 row">
		<div class="col-md-4">
			<label for="inputConsultants" class="col-form-label text-dark fs-6 fw-medium">Consultants</label>
			<label class="m-0 d-block form-text text-secondary fs-7">Add all the consultants and due credits</label>
		</div>
		<div class="col-md-8">
			<textarea id="inputConsultants" class="form-control @error('form.consultants') is-invalid @enderror" wire:model="form.consultants" rows="5"></textarea>
			@error('form.consultants')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="mb-3 row">
		<div class="col-md-4">
			<label for="inputDesignTeam" class="col-form-label text-dark fs-6 fw-medium">Design Team</label>
			<label class="m-0 d-block form-text text-secondary fs-7">Tag team members who worked on the project</label>
		</div>
		<div class="col-md-8">
			<textarea id="inputDesignTeam" class="form-control @error('form.designTeam') is-invalid @enderror" wire:model="form.designTeam" rows="5"></textarea>
			@error('form.designTeam')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<hr class="border-gray-300">
	@include('users.includes.architect.add-story.cover-image-field', ['subLabel' => 'This will be displayed on your media kit.<br>Kindly add a relevant cover image. For example, image of project/ product/ team/ brand logo/ founder/ event etc.'])
	<hr class="border-gray-300">
	<div class="mb-3 row">
		<div class="col-md-4">
			<label for="inputProjectBrief" class="col-form-label text-dark fs-6 fw-medium">Project Brief <span class="text-danger">*</span></label>
			<label class="m-0 d-block form-text text-secondary fs-7">Write in 50-75 words (this text will be used in pitch to journalists)</label>
		</div>
		<div class="col-md-8">
			<textarea id="inputProjectBrief" class="form-control @error('form.projectBrief') is-invalid @enderror" wire:model="form.projectBrief" wire:keydown.debounce.1000ms="characterCount" rows="8"></textarea>
			@error('form.projectBrief')<div class="invalid-feedback">{{ $message }}</div>@enderror
			<div id="projectBriefHelp" class="form-text {{ $form->projectBriefLength < 0 ? 'text-danger' : '' }}">{{ $form->projectBriefLength }} characters left</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<label for="inputpProjectFile" class="col-form-label text-dark fs-6 fw-medium">Upload Project Text <span class="text-danger">*</span></label>
			<label class="m-0 d-block form-text text-secondary fs-7">
				Upload project text or Add Drive Link.
				<br>
				Ideal text length is 500 to 800 words.
			</label>
		</div>
		<div class="col-md-8">
			<div class="mb-2 card">
				<div class="bg-white border card-body rounded-3 border-light">
					<div class="row align-items-center">
						<div class="col-12" x-data="fileUpload('form.projectFile')">
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
									<label for="projectFile"><span class="text-purple-700 cursor-pointer fw-semibold">Click to upload</span></label> or drag and drop
								</p>
								<input type="file" id="projectFile" class="d-none" @change="handleFileSelect">
								@if($form->projectFile)
									<ul class="mt-3 list-disc">
										@if(method_exists($form->projectFile, 'getClientOriginalName'))
											<li>
												{{ $form->projectFile->getClientOriginalName() }}
												<button type="button" class="btn btn-link text-danger text-decoration-none" @click="removeUpload('{{ $form->projectFile->getFilename() }}')">X</button>
											</li>
										@else
											<li style="list-style: none;">
												<a href="{{ Storage::url($form->projectFile) }}" class="text-purple-700">See Document</a>
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
			@error('form.projectFile')<div class="error">{{ $message }}</div>@enderror
			<div class="mb-3">
				<input type="text" class="form-control @error('form.projectLink') is-invalid @enderror" wire:model="form.projectLink" placeholder="Insert drive link" aria-describedby="projectLinkAddon">
				@error('form.projectLink')<div class="invalid-feedback">{{ $message }}</div>@enderror
			</div>
		</div>
	</div>
	<hr class="border-gray-300">
	<div class="mb-3 row">
		<div class="col-md-4">
			<label for="inputText" class="col-form-label text-dark fs-6 fw-medium">Upload Photographs</label>
			<label class="m-0 d-block form-text text-secondary fs-7">Choose the best images{{--  (maximum upload limit 4MB each image) --}}</label>
		</div>
		<div class="col-md-8">
			<div class="mb-2 card">
				<div class="bg-white border card-body rounded-3 border-light">
					<div class="row align-items-center">
						<div class="col-12" x-data="fileUpload('form.photographsFiles')">
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
									<label for="photographsFiles"><span class="text-purple-700 cursor-pointer fw-semibold">Click to upload</span></label> or drag and drop
								</p>
								<input type="file" id="photographsFiles" class="d-none" @change="handleFilesSelect" multiple>
								@if(count($form->photographsFiles) > 0 || count($form->oldPhotographsFiles) > 0)
									<ul class="flex-wrap mt-3 d-flex" style="list-style: none;">
										@foreach ($form->oldPhotographsFiles as $photographsFile)
											<li class="p-2 position-relative" wire:key="{{ $photographsFile->id }}">
												<img class="img-fluid img-thumbnail" width="150" src="{{ Storage::url($photographsFile->image_path) }}" alt="">
												<button type="button" class="top-0 btn btn-sm btn-secondary rounded-circle text-decoration-none position-absolute end-0" wire:click="removeImage('{{ $photographsFile->id }}')">X</button>
											</li>
										@endforeach
										@foreach ($form->photographsFiles as $key => $photographsFile)
											@if(method_exists($photographsFile, 'temporaryUrl'))
												<li class="p-2 position-relative" wire:key="{{ $key }}">
													<img class="img-fluid img-thumbnail" width="150" src="{{ $photographsFile->temporaryUrl() }}" alt="">
													<button type="button" class="top-0 btn btn-sm btn-secondary rounded-circle text-decoration-none position-absolute end-0" @click="removeUpload('{{ $photographsFile->getFilename() }}')">X</button>
												</li>
											@else
												<li class="p-2 position-relative" wire:key="{{ $key }}">
													<img class="img-fluid img-thumbnail" width="150" src="{{ Storage::url($photographsFile) }}" alt="">
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
			@error('form.photographsFiles')<div class="error">{{ $message }}</div>@enderror
			@error('form.photographsFiles.*')<div class="error">{{ $message }}</div>@enderror
			<div class="mb-3">
				<input type="text" class="form-control @error('form.photographsLink') is-invalid @enderror" wire:model="form.photographsLink" placeholder="Insert drive link" aria-describedby="photographsLinkAddon">
				@error('form.photographsLink')<div class="invalid-feedback">{{ $message }}</div>@enderror
			</div>
		</div>
	</div>
	@include('users.includes.input-audio-video-url')
	<hr class="border-gray-300">
	<div class="row">
		<div class="col-md-4">
			<label for="inputText" class="col-form-label text-dark fs-6 fw-medium">Upload Renders/Drawings</label>
			<label class="m-0 d-block form-text text-secondary fs-7">Upload or Add Drive link.</label>
		</div>
		<div class="col-md-8">
			<div class="mb-2 card">
				<div class="bg-white border card-body rounded-3 border-light">
					<div class="row align-items-center">
						<div class="col-12" x-data="fileUpload('form.drawingsFiles')">
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
									<label for="drawingsFiles"><span class="text-purple-700 cursor-pointer fw-semibold">Click to upload</span></label> or drag and drop
								</p>
								<input type="file" id="drawingsFiles" class="d-none" @change="handleFilesSelect" multiple>
								@if(count($form->drawingsFiles) > 0 || count($form->oldDrawingsFiles) > 0)
									<ul class="flex-wrap mt-3 d-flex" style="list-style: none;">
										@foreach ($form->oldDrawingsFiles as $drawingsFile)
											<li class="p-2 position-relative" wire:key="{{ $drawingsFile->id }}">
												<img class="img-fluid img-thumbnail" width="150" src="{{ Storage::url($drawingsFile->image_path) }}" alt="">
												<button type="button" class="top-0 btn btn-sm btn-secondary rounded-circle text-decoration-none position-absolute end-0" wire:click="removeImage('{{ $drawingsFile->id }}')">X</button>
											</li>
										@endforeach
										@foreach ($form->drawingsFiles as $key => $drawingsFile)
											@if(method_exists($drawingsFile, 'temporaryUrl'))
												<li class="p-2 position-relative" wire:key="{{ $key }}">
													<img class="img-fluid img-thumbnail" width="150" src="{{ $drawingsFile->temporaryUrl() }}" alt="">
													<button type="button" class="top-0 btn btn-sm btn-secondary rounded-circle text-decoration-none position-absolute end-0" @click="removeUpload('{{ $drawingsFile->getFilename() }}')">X</button>
												</li>
											@else
												<li class="p-2 position-relative" wire:key="{{ $key }}">
													<img class="img-fluid img-thumbnail" width="150" src="{{ Storage::url($drawingsFile) }}" alt="">
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
			@error('form.drawingsFiles')<div class="error">{{ $message }}</div>@enderror
			<div class="mb-0">
				<input type="text" class="form-control @error('form.drawingsLink') is-invalid @enderror" wire:model="form.drawingsLink" placeholder="Insert drive link">
				@error('form.drawingsLink')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
	@include('users.includes.select-media-kit-access-contact')
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
			{{ isset($edit) ? 'Save Project' : 'Submit Project' }} <x-users.spinners.white-btn wire:target="add" />
		</button>
	</div>
	@include('users.includes.common.file-upload-script', ['width' => 800, 'height' => 400])
	@include('users.includes.architect.add-story.modal-delete-media-kit')
</form>
