<div class="row">
	<label for="inputPublication" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Publication Name</label>
	<div class="col-md-8">
		<input type="text" id="inputPublication" class="form-control @error('publicationName') is-invalid @enderror" wire:model="publicationName">
		@error('publicationName')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
</div>
<hr class="border-gray-300">
<div class="row">
	<label for="inputWebsite" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Website</label>
	<div class="col-md-8">
		<input type="text" id="inputWebsite" class="form-control @error('website') is-invalid @enderror" wire:model="website">
		@error('website')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
</div>
<hr class="border-gray-300">
<div class="row">
	<div class="col-md-4">
		<label for="inputText" class="col-form-label text-dark fs-6 fw-medium">Publication Logo</label>
	</div>
	<div class="col-md-8">
		<div class="row g-2">
			<div class="col-auto">
				<p class="p-0 m-0">
					@if ($profileImage)
						<img class="img-fluid img-64 rounded-circle" src="{{ $profileImage->temporaryUrl() }}" alt="...">
					@else
					<img class="img-fluid img-64 rounded-circle" src="{{ $profileImageOld ? Storage::url($profileImageOld->image_path) : 'https://via.placeholder.com/64x64' }}" alt="..." />
					@endif
				</p>
			</div>
			@include('users.includes.common.profile-image-field')
		</div>
	</div>
</div>
<hr class="border-gray-300">
<div class="mb-3 row">
	<label for="selectedLanguages" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Language</label>
	<div class="col-md-8">
		{{-- <select id="selectLanguage" class="form-select @error('language') is-invalid @enderror" wire:model="language">
			<option value="">Select Language</option>
			@foreach ($languages as $language)
				<option value="{{ $language->id }}">{{ $language->name }}</option>
			@endforeach
		</select> --}}
		<div class="row">
			@foreach ($languages as $language)
			<div class="col-6">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="{{ $language->id }}" id="language-{{ $language->id }}" wire:model="selectedLanguages">
					<label class="form-check-label" for="language-{{ $language->id }}">{{ $language->name }}</label>
				</div>
			</div>
			@endforeach
		</div>
		@error('selectedLanguages')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
</div>
<div class="row">
	<label for="selectPosition" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Role</label>
	<div class="col-md-8">
		<select id="selectPosition" class="form-select @error('position') is-invalid @enderror" wire:model="position">
			<option value="">Select Role</option>
			@foreach ($positions as $position)
				<option value="{{ $position->id }}">{{ $position->name }}</option>
			@endforeach
		</select>
		@error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
</div>
<hr class="border-gray-300">
<div class="mb-3 row">
	<label for="selectCountry" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Country</label>
	<div class="col-md-8">
		<select class="form-select @error('selectedCountry') is-invalid @enderror" id="selectCountry" wire:model="selectedCountry">
			<option value="0">Select Country</option>
			@foreach ($countries as $country)
			<option value="{{ $country->name }}">{{ str()->headline($country->name) }}</option>
			@endforeach
		</select>
		@error('selectedCountry')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
</div>
{{-- <div class="mb-3 row">
	<label for="selectState" class="col-md-4 col-form-label text-dark fs-6 fw-medium">State</label>
	<div class="col-md-8">
		<select class="form-select @error('selectedState') is-invalid @enderror" id="selectState" wire:model.live="selectedState">
			<option value="0">Select State</option>
			@foreach ($states as $state)
			<option value="{{ $state->id }}">{{ str()->headline($state->name) }}</option>
			@endforeach
		</select>
		@error('selectedState')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
</div> --}}
{{-- <div class="row">
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
</div> --}}
<hr class="border-gray-300">
<div class="row">
	<label for="" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Category</label>
	<div class="col-md-8">
		<div class="row">
			@foreach ($categories as $category)
			<div class="col-6">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="cat-{{ $category->id }}" wire:model="selectedCategories">
					<label class="form-check-label" for="cat-{{ $category->id }}">{{ $category->name }}</label>
				</div>
			</div>
			@endforeach
		</div>
		@error('selectedCategories')<div class="error">{{ $message }}</div>@enderror
	</div>
</div>
<hr class="border-gray-300">
<div class="mb-3 row">
	<label class="col-md-4 col-form-label text-dark fs-6 fw-medium">Publish Stories From</label>
	<div class="col-md-8">
		<div class="row">
			@foreach ($publishFrom as $publish)
			<div class="col-6">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="{{ $publish->id }}" id="publish-{{ $publish->id }}" wire:model="selectedPublishFrom">
					<label class="form-check-label" for="publish-{{ $publish->id }}">{{ $publish->name }}</label>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	@error('selectedPublishFrom')<div class="error">{{ $message }}</div>@enderror
</div>
<div class="row">
	<label class="col-md-4 col-form-label text-dark fs-6 fw-medium">Publication Type</label>
	<div class="col-md-8">
		<div class="row">
			@foreach ($publicationTypes as $publicationType)
			<div class="col-6">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="{{ $publicationType->id }}" id="pub-{{ $publicationType->id }}" wire:model="selectedPublicationTypes">
					<label class="form-check-label" for="pub-{{ $publicationType->id }}">{{ $publicationType->name }}</label>
				</div>
			</div>
			@endforeach
		</div>
		@error('selectedPublicationTypes')<div class="error">{{ $message }}</div>@enderror
	</div>
</div>
<hr class="border-gray-300">
<div class="mb-3 row">
	<div class="col-md-4">
		<label for="inputMonthlyVisitors" class="col-form-label text-dark fs-6 fw-medium">Monthly Visitors</label>
	</div>
	<div class="col-md-8">
		<input id="inputMonthlyVisitors" class="form-control @error('monthlyVisitors') is-invalid @enderror" wire:model="monthlyVisitors">
		@error('monthlyVisitors')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
</div>
<div class="mb-3 row">
	<div class="col-md-4">
		<label for="inputStartingYear" class="col-form-label text-dark fs-6 fw-medium">Starting Year</label>
	</div>
	<div class="col-md-8">
		<input id="inputStartingYear" class="form-control @error('startingYear') is-invalid @enderror" wire:model="startingYear">
		@error('startingYear')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<label for="inputAboutMe" class="col-form-label text-dark fs-6 fw-medium">About the Publication</label>
		<label class="m-0 d-block form-text text-secondary fs-7">Write short introduction about publication.</label>
	</div>
	<div class="col-md-8">
		<textarea id="inputAboutMe" class="form-control @error('aboutMe') is-invalid @enderror" wire:model="aboutMe" wire:keydown.debounce="characterCount" rows="6"></textarea>
		@error('aboutMe')<div class="invalid-feedback">{{ $message }}</div>@enderror
		<div id="aboutMeHelp" class="form-text {{ $aboutMeLength < 0 ? 'text-danger' : '' }}">{{ $aboutMeLength }} characters left</div>
	</div>
</div>
<hr class="border-gray-300">
<div class="row justify-content-end align-items-end g-2">
	<div class="col-auto">
		<button type="button" class="btn btn-white fw-medium" wire:click="add">
			Cancel <x-users.spinners.primary-btn wire:target="add" />
		</button>
	</div>
	<div class="col-auto">
		<button type="submit" class="btn btn-primary fw-medium">
			Save <x-users.spinners.white-btn wire:target="update" />
		</button>
	</div>
</div>
