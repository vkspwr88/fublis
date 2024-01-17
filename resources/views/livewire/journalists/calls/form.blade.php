<form wire:submit="preview" class="pt-5">
	<div class="row mb-3">
		<label for="selectCategory" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Category</label>
		<div class="col-md-8">
			<select class="form-select @error('category') is-invalid @enderror" id="selectCategory" wire:model="category">
				<option value="">Select Category</option>
				@foreach ($categories as $category)
				<option value="{{ $category->id }}">{{ $category->name }}</option>
				@endforeach
			</select>
			@error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="row mb-3">
		<label for="inputTitle" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Title</label>
		<div class="col-md-8">
			<input type="text" id="inputTitle" class="form-control @error('title') is-invalid @enderror" wire:model="title" wire:keydown.debounce="characterCount">
			@error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
			<div id="titleHelp" class="form-text {{ $titleTextLength < 0 ? 'text-danger' : '' }}">{{ $titleTextLength }} characters left</div>
		</div>
	</div>
	<div class="row mb-3">
		<div class="col-md-4">
			<label for="inputDescription" class="col-form-label text-dark fs-6 fw-medium">Describe story requirements briefly </label>
			<label class="d-block form-text text-secondary fs-7 m-0">Write in 50-75 words</label>
		</div>
		<div class="col-md-8">
			<textarea id="inputDescription" class="form-control @error('description') is-invalid @enderror" rows="6" wire:model="description" wire:keydown.debounce="characterCount"></textarea>
			@error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
			<div id="descriptionHelp" class="form-text {{ $descriptionTextLength < 0 ? 'text-danger' : '' }}">{{ $descriptionTextLength }} characters left</div>
		</div>
	</div>
	{{-- <div class="row mb-3">
		<label for="selectLocation" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Location</label>
		<div class="col-md-8">
			<select class="form-select @error('location') is-invalid @enderror" id="selectLocation" wire:model="location">
				<option value="">Select Location</option>
				@foreach ($locations as $location)
				<option value="{{ $location->id }}">{{ $location->name }}</option>
				@endforeach
			</select>
			@error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div> --}}
	<div class="row mb-3">
		<label for="selectCountry" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Country</label>
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
		<label for="selectState" class="col-md-4 col-form-label text-dark fs-6 fw-medium">State</label>
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
		<label for="selectCity" class="col-md-4 col-form-label text-dark fs-6 fw-medium">City</label>
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
		<label for="selectPublication" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Publication Title</label>
		<div class="col-md-8">
			<select class="form-select @error('publication') is-invalid @enderror" id="selectPublication" wire:model="publication">
				<option value="">Select Publication</option>
				@foreach ($publications as $publication)
				<option value="{{ $publication->id }}">{{ $publication->name }}</option>
				@endforeach
			</select>
			@error('publication')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="row mb-3">
		<label for="selectLanguage" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Language</label>
		<div class="col-md-8">
			<select class="form-select @error('language') is-invalid @enderror" id="selectLanguage" wire:model="language">
				<option value="">Select Language</option>
				@foreach ($languages as $language)
				<option value="{{ $language->id }}">{{ $language->name }}</option>
				@endforeach
			</select>
			@error('language')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="row mb-3">
		<label for="inputSubmissionEndsDate" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Submission ends</label>
		<div class="col-md-8">
			<input type="text" id="inputSubmissionEndsDate" class="form-control datepicker @error('submissionEndsDate') is-invalid @enderror" wire:model="submissionEndsDate">
			@error('submissionEndsDate')<div class="invalid-feedback">{{ $message }}</div>@enderror
		</div>
	</div>
	<div class="text-end">
		<button class="btn btn-white fs-6 fw-semibold" type="button">Cancel</button>
		<button class="btn btn-primary fs-6 fw-semibold" type="submit">
			Next <x-users.spinners.white-btn wire:target="preview" />
		</button>
	</div>
</form>
