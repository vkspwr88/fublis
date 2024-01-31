<form wire:submit="update">
	<div class="row pt-4 g-4 justify-content-end align-items-end">
		<div class="col">
			<h4 class="text-dark fs-6 fw-semibold m-0 p-0">Your Publications</h4>
			<p class="text-secondary fs-6 m-0 p-0">
				<small>Add or Remove Publications</small>
			</p>
		</div>
	</div>

	<hr class="border-gray-300 my-4">

	<div class="row g-4">
		<div class="col-md-12">
			<div class="row g-3">
				@foreach ($publications as $publication)
				<div class="col-12">
					<div class="row align-items-center g-2">
						{{-- <div class="col-auto">
							<a href="javascript:;" class="text-dark fs-4" wire:click="delete('{{ $publication->id }}')"><i class="bi bi-x"></i></a>
						</div> --}}
						<div class="col-auto">
							<img class="rounded-circle img-square img-48" src="{{ $publication->profileImage ? Storage::url($publication->profileImage->image_path) : 'https://via.placeholder.com/48x48' }}" alt="..." />
						</div>
						<div class="col-auto">
							<h6 class="fs-6 fw-medium m-0 p-0">
								<a href="{{ route('journalist.account.profile.publications.view', ['publication' => $publication->slug]) }}" class="text-purple-700">{{ $publication->name }}</a>
							</h6>
							<p class="fs-7 m-0 p-0">
								<a href="{{ $publication->website }}" class="text-secondary">{{ trimWebsiteUrl($publication->website) }}</a>
							</p>
						</div>
						<div class="col-auto ms-4 align-self-end">
							<a href="javascript:;" class="text-purple-700" wire:click="edit('{{ $publication->id }}')">
								<span wire:loading.remove><i class="bi bi-pencil-square"></i></span>
								<x-users.spinners.primary-btn wire:target="edit('{{ $publication->id }}')" />
							</a>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<hr class="border-gray-300">
		</div>
		<div class="col-md-12">
			<h4 class="text-dark fs-6 fw-semibold m-0 p-0 mb-4">
				@if($isNew)
				Add new Publication
				@else
				Edit {{ $publication->name }}
				<button type="button" class="btn btn-primary btn-sm fw-medium" wire:click="add">
					Add New <x-users.spinners.white-btn wire:target="add" />
				</button>
				@endif
			</h4>
		</div>
		<div class="col-md-9">
			@include('users.includes.journalist.publication-form')
			{{-- <div class="row">
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
					<div class="input-group">
						<span class="input-group-text bg-white text-secondary" id="websiteAddon">http://</span>
						<input type="text" id="inputWebsite" class="form-control @error('website') is-invalid @enderror" wire:model="website">
						@error('website')<div class="invalid-feedback">{{ $message }}</div>@enderror
					</div>
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
							<p class="m-0 p-0">
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
			<div class="row mb-3">
				<label for="selectedLanguages" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Language</label>
				<div class="col-md-8">
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
			<div class="row">
				<label class="col-md-4 col-form-label text-dark fs-6 fw-medium">Category</label>
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
			<div class="row mb-3">
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
			<div class="row mb-3">
				<div class="col-md-4">
					<label for="inputAboutMe" class="col-form-label text-dark fs-6 fw-medium">About the Publication</label>
					<label class="d-block form-text text-secondary fs-7 m-0">Write short introduction about publication.</label>
				</div>
				<div class="col-md-8">
					<textarea id="inputAboutMe" class="form-control @error('aboutMe') is-invalid @enderror" wire:model="aboutMe" rows="6"></textarea>
					@error('aboutMe')<div class="invalid-feedback">{{ $message }}</div>@enderror
					<div id="aboutMeHelp" class="form-text">275 characters left</div>
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
			</div> --}}
		</div>
	</div>

	{{-- <div class="row">
		<div class="col-md-8">
			<div class="row">
				<label for="inputPassword" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Current password</label>
				<div class="col-md-8">
					<input type="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" wire:model="password">
					@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
				</div>
			</div>
			<hr class="border-gray-300">
			<div class="row">
				<label for="inputConfirmNewPassword" class="col-md-4 col-form-label text-dark fs-6 fw-medium">New password</label>
				<div class="col-md-8">
					<input type="password" id="inputConfirmNewPassword" class="form-control @error('newPassword_confirmation') is-invalid @enderror" wire:model="newPassword_confirmation">
					@error('newPassword_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
				</div>
			</div>
			<hr class="border-gray-300">
			<div class="row">
				<label for="inputNewPassword" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Confirm new password</label>
				<div class="col-md-8">
					<input type="password" id="inputNewPassword" class="form-control @error('newPassword') is-invalid @enderror" wire:model="newPassword">
					@error('newPassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
				</div>
			</div>
			<hr class="border-gray-300">
			<div class="row justify-content-end align-items-end g-2">
				<div class="col-auto">
					<button type="button" class="btn btn-white fw-medium" wire:click="refresh">
						Cancel <x-users.spinners.primary-btn wire:target="refresh" />
					</button>
				</div>
				<div class="col-auto">
					<button type="submit" class="btn btn-primary fw-medium">
						Update password <x-users.spinners.white-btn wire:target="update" />
					</button>
				</div>
			</div>
		</div>
	</div> --}}

	@include('users.includes.common.file-upload-script')
</form>
