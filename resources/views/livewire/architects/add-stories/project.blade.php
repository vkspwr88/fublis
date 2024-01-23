<form wire:submit="add" class="pt-4">
	<div class="row mb-3">
		<label for="inputProjectTitle" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Title <span class="text-danger">*</span></label>
		<div class="col-md-8">
			<input type="text" id="inputProjectTitle" class="form-control @error('projectTitle') is-invalid @enderror" wire:model="projectTitle">
			@error('projectTitle')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="row">
		<label for="selectCategory" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Category <span class="text-danger">*</span></label>
		<div class="col-md-8">
			<select id="selectCategory" class="form-select @error('category') is-invalid @enderror" wire:model.live="category">
				<option value="">Select Category</option>
				@foreach ($categories as $category)
					<option value="{{ $category->id }}">{{ $category->name }}</option>
				@endforeach
			</select>
			@error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<hr class="border-gray-300">
	@if($showOtherFields)
		<div class="row mb-3">
			<label for="inputSiteArea" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Site Area</label>
			<div class="col-md-8">
				<div class="input-group">
					<input type="text" id="inputSiteArea" class="form-control @error('siteArea') is-invalid @enderror" wire:model="siteArea">
					<select id="selectSiteArea" class="form-select @error('siteAreaUnit') is-invalid @enderror" wire:model="siteAreaUnit" style="max-width: 140px;">
						<option value="">Select</option>
						@foreach ($areas as $area)
							<option value="{{ $area->id }}">{{ $area->name }}</option>
						@endforeach
					</select>
					@error('siteArea')<div class="invalid-feedback">{{ $message }}</div>@enderror
					@error('siteAreaUnit')<div class="invalid-feedback">{{ $message }}</div>@enderror
				</div>
			</div>
		</div>
		<div class="row mb-3">
			<label for="inputBuiltUpArea" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Built Up Area</label>
			<div class="col-md-8">
				<div class="input-group">
					<input type="text" id="inputBuiltUpArea" class="form-control @error('builtUpArea') is-invalid @enderror" wire:model="builtUpArea">
					<select id="selectBuiltUpArea" class="form-select @error('builtUpAreaUnit') is-invalid @enderror" wire:model="builtUpAreaUnit" style="max-width: 140px;">
						<option value="">Select</option>
						@foreach ($areas as $area)
							<option value="{{ $area->id }}">{{ $area->name }}</option>
						@endforeach
					</select>
					@error('builtUpArea')<div class="invalid-feedback">{{ $message }}</div>@enderror
					@error('builtUpAreaUnit')<div class="invalid-feedback">{{ $message }}</div>@enderror
				</div>
			</div>
		</div>
		<div class="row mb-3">
			<label for="inputMaterials" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Materials</label>
			<div class="col-md-8">
				<input type="text" id="inputMaterials" class="form-control @error('materials') is-invalid @enderror" wire:model="materials">
				@error('materials')<div class="invalid-feedback">{{ $message }}</div>@enderror
			</div>
		</div>
		<div class="row mb-3">
			<label for="selectBuildingTypology" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Building Typology</label>
			<div class="col-md-8">
				<select id="selectBuildingTypology" class="form-select @error('buildingTypology') is-invalid @enderror" wire:model.live="buildingTypology">
					<option value="">Select Building Typology</option>
					@foreach ($buildingTypologies as $buildingTypology)
						<option value="{{ $buildingTypology->id }}">{{ $buildingTypology->name }}</option>
					@endforeach
				</select>
				@error('buildingTypology')<div class="invalid-feedback">{{ $message }}</div>@enderror
			</div>
		</div>
		<div class="row mb-3">
			<label for="selectBuildingUse" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Building Use</label>
			<div class="col-md-8">
				<select id="selectBuildingUse" class="form-select @error('buildingUse') is-invalid @enderror" wire:model="buildingUse">
					<option value="">Select Building Use</option>
					@foreach ($buildingUses as $buildingUse)
						<option value="{{ $buildingUse->id }}">{{ $buildingUse->name }}</option>
					@endforeach
				</select>
				@error('buildingUse')<div class="invalid-feedback">{{ $message }}</div>@enderror
			</div>
		</div>
	@endif
	{{-- <div class="row mb-3">
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
	<div class="row mb-3">
		<label for="selectCountry" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Country <span class="text-danger">*</span></label>
		<div class="col-md-8">
			<select class="form-select @error('selectedCountry') is-invalid @enderror" id="selectCountry" wire:model.live="selectedCountry">
				<option value="">Select Country</option>
				@foreach ($countries as $country)
				<option value="{{ $country->id }}">{{ str()->headline($country->name) }}</option>
				@endforeach
			</select>
			@error('selectedCountry')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="row mb-3">
		<label for="selectState" class="col-md-4 col-form-label text-dark fs-6 fw-medium">State <span class="text-danger">*</span></label>
		<div class="col-md-8">
			<select class="form-select @error('selectedState') is-invalid @enderror" id="selectState" wire:model.live="selectedState">
				<option value="">Select State</option>
				@foreach ($states as $state)
				<option value="{{ $state->id }}">{{ str()->headline($state->name) }}</option>
				@endforeach
			</select>
			@error('selectedState')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="row mb-3">
		<label for="selectCity" class="col-md-4 col-form-label text-dark fs-6 fw-medium">City <span class="text-danger">*</span></label>
		<div class="col-md-8">
			<select class="form-select @error('selectedCity') is-invalid @enderror" id="selectCity" wire:model="selectedCity">
				<option value="">Select City</option>
				@foreach ($cities as $city)
				<option value="{{ $city->name }}">{{ str()->headline($city->name) }}</option>
				@endforeach
			</select>
			@error('selectedCity')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="row mb-3">
		<label for="selectStatus" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Status <span class="text-danger">*</span></label>
		<div class="col-md-8">
			<select id="selectStatus" class="form-select @error('status') is-invalid @enderror" wire:model="status">
				<option value="">Select Status</option>
				@foreach ($statuses as $status)
					<option value="{{ $status->id }}">{{ $status->name }}</option>
				@endforeach
			</select>
			@error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
		<label for="inputTextCredits" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Text Credits</label>
		<div class="col-md-8">
			<input type="text" id="inputTextCredits" class="form-control @error('textCredits') is-invalid @enderror" wire:model="textCredits">
			@error('textCredits')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="row mb-3">
		<label for="inputRenderCredits" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Render Credits</label>
		<div class="col-md-8">
			<input type="text" id="inputRenderCredits" class="form-control @error('renderCredits') is-invalid @enderror" wire:model="renderCredits">
			@error('renderCredits')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="row mb-3">
		<div class="col-md-4">
			<label for="inputConsultants" class="col-form-label text-dark fs-6 fw-medium">Consultants</label>
			<label class="d-block form-text text-secondary fs-7 m-0">Add all the consultants and due credits</label>
		</div>
		<div class="col-md-8">
			<textarea id="inputConsultants" class="form-control @error('consultants') is-invalid @enderror" wire:model="consultants" rows="5"></textarea>
			@error('consultants')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="row mb-3">
		<div class="col-md-4">
			<label for="inputDesignTeam" class="col-form-label text-dark fs-6 fw-medium">Design Team</label>
			<label class="d-block form-text text-secondary fs-7 m-0">Tag team members who worked on the project</label>
		</div>
		<div class="col-md-8">
			<textarea id="inputDesignTeam" class="form-control @error('designTeam') is-invalid @enderror" wire:model="designTeam" rows="5"></textarea>
			@error('designTeam')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<hr class="border-gray-300">
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
		<div class="col-md-4">
			<label for="inputProjectBrief" class="col-form-label text-dark fs-6 fw-medium">Project Brief <span class="text-danger">*</span></label>
			<label class="d-block form-text text-secondary fs-7 m-0">Write in 50-75 words (this text will be used in pitch to journalists)</label>
		</div>
		<div class="col-md-8">
			<textarea id="inputProjectBrief" class="form-control @error('projectBrief') is-invalid @enderror" wire:model="projectBrief" wire:keydown.debounce="characterCount" rows="8"></textarea>
			@error('projectBrief')<div class="invalid-feedback">{{ $message }}</div>@enderror
			<div id="projectBriefHelp" class="form-text {{ $projectBriefLength < 0 ? 'text-danger' : '' }}">{{ $projectBriefLength }} characters left</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<label for="inputpProjectFile" class="col-form-label text-dark fs-6 fw-medium">Upload Project Text <span class="text-danger">*</span></label>
			<label class="d-block form-text text-secondary fs-7 m-0">Add the text in 500-800 words</label>
		</div>
		<div class="col-md-8">
			<div class="card mb-2">
				<div class="card-body bg-white rounded-3 border border-light">
					<div class="row align-items-center">
						<div class="col-12" x-data="fileUpload('projectFile')">
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
									<label for="inputpProjectFile"><span class="text-purple-700 fw-semibold cursor-pointer">Click to upload</span></label> or drag and drop
								</p>
								<input type="file" id="inputpProjectFile" class="d-none" @change="handleFileSelect">
								@if($projectFile)
									<ul class="mt-3 list-disc">
										<li>
											{{ $projectFile->getClientOriginalName() }}
											<button type="button" class="btn btn-link text-danger text-decoration-none" @click="removeUpload('{{ $projectFile->getFilename() }}')">X</button>
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
			@error('projectFile')<div class="error">{{ $message }}</div>@enderror
			<div class="input-group mb-3">
				<span class="input-group-text bg-white" id="projectLinkAddon">http://</span>
				<input type="text" class="form-control @error('projectLink') is-invalid @enderror" wire:model="projectLink" placeholder="Insert drive link" aria-describedby="projectLinkAddon">
				@error('projectLink')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
								<input type="file" id="inputPhotographsFiles" class="d-none" @change="handleFilesSelect" multiple>
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
					</div>
				</div>
			</div>
			@error('photographsFiles')<div class="error">{{ $message }}</div>@enderror
			<div class="input-group mb-3">
				<span class="input-group-text bg-white" id="photographsLinkAddon">http://</span>
				<input type="text" class="form-control @error('photographsLink') is-invalid @enderror" wire:model="photographsLink" placeholder="Insert drive link" aria-describedby="photographsLinkAddon">
				@error('photographsLink')<div class="invalid-feedback">{{ $message }}</div>@enderror
			</div>
		</div>
	</div>
	<hr class="border-gray-300">
	<div class="row">
		<div class="col-md-4">
			<label for="inputText" class="col-form-label text-dark fs-6 fw-medium">Upload renders/drawings</label>
			<label class="d-block form-text text-secondary fs-7 m-0">Add content</label>
		</div>
		<div class="col-md-8">
			<div class="card mb-2">
				<div class="card-body bg-white rounded-3 border border-light">
					<div class="row align-items-center">
						<div class="col-12" x-data="fileUpload('drawingsFiles')">
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
									<label for="inputDrawingsFiles"><span class="text-purple-700 fw-semibold cursor-pointer">Click to upload</span></label> or drag and drop
								</p>
								<input type="file" id="inputDrawingsFiles" class="d-none" @change="handleFilesSelect" multiple>
								@if(count($drawingsFiles) > 0)
									<ul class="mt-3 list-disc">
										@foreach ($drawingsFiles as $drawingsFile)
										<li>
											{{ $drawingsFile->getClientOriginalName() }}
											<button type="button" class="btn btn-link text-danger text-decoration-none" @click="removeUpload('{{ $drawingsFile->getFilename() }}')">X</button>
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
			@error('drawingsFiles')<div class="error">{{ $message }}</div>@enderror
			<div class="input-group mb-3">
				<span class="input-group-text bg-white" id="drawingsLinkAddon">http://</span>
				<input type="text" class="form-control @error('drawingsLink') is-invalid @enderror" wire:model="drawingsLink" placeholder="Insert drive link" aria-describedby="drawingsLinkAddon">
				@error('drawingsLink')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
			Submit Project  <x-users.spinners.white-btn wire:target="add" />
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
