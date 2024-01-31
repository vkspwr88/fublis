<form wire:submit="update">
	<div class="row pt-4 g-4 justify-content-end align-items-end">
		<div class="col">
			<h4 class="text-dark fs-6 fw-semibold m-0 p-0">Personal info</h4>
			<p class="text-secondary fs-6 m-0 p-0">
				<small>Update your photo and personal details here.</small>
			</p>
		</div>
		<div class="col-auto">
			<div class="row justify-content-end align-items-end g-2">
				<div class="col-auto">
					<button type="button" class="btn btn-white fw-medium" wire:click="refresh">
						Cancel <x-users.spinners.primary-btn wire:target="refresh" />
					</button>
				</div>
				<div class="col-auto">
					<button type="submit" class="btn btn-primary fw-medium">
						Save <x-users.spinners.white-btn wire:target="update" />
					</button>
				</div>
			</div>
		</div>
	</div>

	<hr class="border-gray-300 my-4">

	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<label for="inputName" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Name</label>
				<div class="col-md-8">
					<input type="text" id="inputName" class="form-control @error('name') is-invalid @enderror" wire:model="name">
					@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
				</div>
			</div>
			<hr class="border-gray-300">
			<div class="row">
				<label for="inputName" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Email address</label>
				<div class="col-md-8">
					<input type="text" id="inputName" class="form-control @error('email') is-invalid @enderror" wire:model="email">
					@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
				</div>
			</div>
			<hr class="border-gray-300">
			<div class="row">
				<div class="col-md-4">
					<label for="inputText" class="col-form-label text-dark fs-6 fw-medium">Your photo</label>
					<label class="d-block form-text text-secondary fs-7 m-0">This will be displayed on your profile.</label>
				</div>
				<div class="col-md-8">
					<div class="row g-2">
						<div class="col-auto">
							@php
								$profileImageSrc = 'https://via.placeholder.com/64x64';
								//if(method_exists($profileImage, 'temporaryUrl')){
								if($profileImage && method_exists($profileImage, 'temporaryUrl')){
									$profileImageSrc = $profileImage->temporaryUrl();
								}
								elseif ($profileImageOld) {
									$profileImageSrc = Storage::url($profileImageOld->image_path);
								}
							@endphp
							<p class="m-0 p-0">
								<img class="img-fluid img-64 rounded-circle" src="{{ $profileImageSrc }}" alt="..." />
							</p>
						</div>
						@include('users.includes.common.profile-image-field')
					</div>
				</div>
			</div>
			<hr class="border-gray-300">
			<div class="row mb-3">
				<label for="inputCompany" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Company</label>
				<div class="col-md-8">
					<input type="text" readonly id="inputCompany" class="form-control @error('company') is-invalid @enderror" wire:model="company">
					@error('company')<div class="invalid-feedback">{{ $message }}</div>@enderror
				</div>
			</div>
			{{-- <div class="row mb-3">
				<label for="selectCompany" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Company</label>
				<div class="col-md-8">
					<select id="selectCompany" class="form-select @error('location') is-invalid @enderror" wire:model="location">
						<option value="">Select Company</option>
						@foreach ($locations as $location)
							<option value="{{ $location->id }}">{{ $location->name }}</option>
						@endforeach
					</select>
					@error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
				</div>
			</div> --}}
			<div class="row">
				<label for="selectRole" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Role</label>
				<div class="col-md-8">
					<select id="selectRole" class="form-select @error('position') is-invalid @enderror" wire:model="position">
						<option value="">Select Role</option>
						@foreach ($positions as $position)
							<option value="{{ $position->id }}">{{ $position->name }}</option>
						@endforeach
					</select>
					@error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
				</div>
			</div>
			<hr class="border-gray-300">
			{{-- <div class="row">
				<label for="selectLocation" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Country</label>
				<div class="col-md-8">
					<select id="selectLocation" class="form-select @error('location') is-invalid @enderror" wire:model="location">
						<option value="">Select Country</option>
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
			<div class="row">
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
			<hr class="border-gray-300">
			<div class="row mb-3">
				<div class="col-md-4">
					<label for="inputAboutMe" class="col-form-label text-dark fs-6 fw-medium">Bio</label>
					<label class="d-block form-text text-secondary fs-7 m-0">Write a short introduction about yourself.</label>
				</div>
				<div class="col-md-8">
					<textarea id="inputAboutMe" class="form-control @error('aboutMe') is-invalid @enderror" wire:model="aboutMe" wire:keydown.debounce="characterCount" rows="6"></textarea>
					@error('aboutMe')<div class="invalid-feedback">{{ $message }}</div>@enderror
					<div id="aboutMeHelp" class="form-text {{ $aboutMeLength < 0 ? 'text-danger' : '' }}">{{ $aboutMeLength }} characters left</div>
				</div>
			</div>
		</div>
	</div>
	@include('users.includes.common.file-upload-script')
</form>
