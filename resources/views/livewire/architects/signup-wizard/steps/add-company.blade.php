<div>
	@include('livewire.architects.signup-wizard.navigation')

	<div class="row bg-white justify-content-center pt-5">
		<div class="col-lg-10">
			<div class="card rounded-4 shadow border border-1">
				<div class="row g-0">
					<div class="col-md-6">
						<div class="row justify-content-between align-items-center">
							<div class="col-12">
								<div class="card-body px-5">
									<form class="py-3" wire:submit="add">
										@if ($new)
											<div class="mb-3">
												<label for="inputCompanyName" class="form-label text-dark fs-6 fw-medium">Company Name</label>
												<input type="text" class="form-control  @error('companyName') is-invalid @enderror" id="inputCompanyName" placeholder="Name of your brand / studio" wire:model="companyName">
												@error('companyName')<div class="invalid-feedback">{{ $message }}</div>@enderror
											</div>
											<div class="mb-3">
												<label for="inputWebsite" class="form-label text-dark fs-6 fw-medium">Website</label>
												<div class="input-group">
													<span class="input-group-text bg-white" id="basic-addon1">http://</span>
													<input type="text" class="form-control @error('website') is-invalid @enderror" id="inputWebsite" placeholder="www.your-website.com" aria-label="Username" aria-describedby="basic-addon1" wire:model="website">
													@error('website')<div class="invalid-feedback">{{ $message }}</div>@enderror
												</div>
											</div>
											{{-- <div class="mb-3">
												<label for="selectLocation" class="form-label text-dark fs-6 fw-medium">Location</label>
												<select class="form-select @error('location') is-invalid @enderror" id="selectLocation" wire:model="location">
													<option value="">Select Location</option>
													@foreach ($locations as $location)
													<option value="{{ $location->id }}">{{ $location->name }}</option>
													@endforeach
												</select>
												@error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
											</div> --}}
											<div class="mb-3">
												<label for="selectCountry" class="form-label text-dark fs-6 fw-medium">Country</label>
												<select class="form-select @error('selectedCountry') is-invalid @enderror" id="selectCountry" wire:model.live="selectedCountry">
													<option value="">Select Country</option>
													@foreach ($countries as $country)
													<option value="{{ $country->id }}">{{ str()->headline($country->name) }}</option>
													@endforeach
												</select>
												@error('selectedCountry')<div class="invalid-feedback">{{ $message }}</div>@enderror
											</div>
											<div class="mb-3">
												<label for="selectState" class="form-label text-dark fs-6 fw-medium">State</label>
												<select class="form-select @error('selectedState') is-invalid @enderror" id="selectState" wire:model.live="selectedState">
													<option value="">Select State</option>
													@foreach ($states as $state)
													<option value="{{ $state->id }}">{{ str()->headline($state->name) }}</option>
													@endforeach
												</select>
												@error('selectedState')<div class="invalid-feedback">{{ $message }}</div>@enderror
											</div>
											<div class="mb-3">
												<label for="selectCity" class="form-label text-dark fs-6 fw-medium">City</label>
												<select class="form-select @error('selectedCity') is-invalid @enderror" id="selectCity" wire:model="selectedCity">
													<option value="">Select City</option>
													@foreach ($cities as $city)
													<option value="{{ $city->name }}">{{ str()->headline($city->name) }}</option>
													@endforeach
												</select>
												@error('selectedCity')<div class="invalid-feedback">{{ $message }}</div>@enderror
											</div>
											<div class="mb-3">
												<label for="selectCategory" class="form-label text-dark fs-6 fw-medium">Category</label>
												<select class="form-select select2-dropdown @error('selectedCategory') is-invalid @enderror" id="selectCategory" wire:model="selectedCategory">
													<option value="">Select Category</option>
													@foreach ($categories as $category)
														<option value="{{ $category->id }}">{{ $category->name }}</option>
													@endforeach
												</select>
												@error('selectedCategory')<div class="invalid-feedback">{{ $message }}</div>@enderror
											</div>
											<div class="mb-3">
												<label for="selectTeamSize" class="form-label text-dark fs-6 fw-medium">Team Size</label>
												<select class="form-select @error('selectedTeamSize') is-invalid @enderror" id="selectTeamSize" wire:model="selectedTeamSize">
													<option value="">Select Team Size</option>
													@foreach ($teamSizes as $teamSize)
													<option value="{{ $teamSize->id }}">{{ $teamSize->name }}</option>
													@endforeach
												</select>
												@error('selectedTeamSize')<div class="invalid-feedback">{{ $message }}</div>@enderror
											</div>
										@else
											<div class="mb-3">
												<label for="searchCompanyName" class="form-label text-dark fs-6 fw-medium">Search for your Company</label>
												<input type="text" class="form-control  @error('companyName') is-invalid @enderror" id="searchCompanyName" placeholder="Enter company name" wire:model.live.debounce.250ms="searchCompanyName">
												@error('selectedCompany')<div class="error">{{ $message }}</div>@enderror
											</div>
											@if($showList)
												<div class="mb-3">
													<div id="searchBox" class="border rounded-3 p-3" style="height: 10.25rem; overflow-y: scroll;">
														<div class="row">
															@forelse ($companies as $company)
																<div class="col-12">
																	<input id="{{ $company->id }}" type="radio" value="{{ $company->id }}" wire:model="selectedCompany">
																	<div class="search-list position-relative p-2 my-1">
																		<label for="{{ $company->id }}" class="text-secondary fs-6 w-100">
																			<span class="fw-bold text-dark">{{ $company->name }}</span>
																			<span>{{ $company->location->name }}</span>
																			<span class="checked position-absolute text-purple-600">
																				<i class="bi bi-check-lg"></i>
																			</span>
																		</label>
																	</div>
																</div>
															@empty
																<div class="col-12">
																	<div class="search-list position-relative p-2 my-1">
																		No Result Found
																	</div>
																</div>
															@endforelse
														</div>
													</div>
												</div>
												<div class="mb-3">
													<a href="javascript:;" class="text-secondary" wire:click="setNew">Can't find?</a>
												</div>
											@endif
										@endif
										<div class="mb-3">
											<label for="selectPosition" class="form-label text-dark fs-6 fw-medium">Your Position in Company</label>
											<select class="form-select @error('selectedPosition') is-invalid @enderror" id="selectPosition" wire:model="selectedPosition">
												<option value="">Select Your Position</option>
												@foreach ($positions as $position)
												<option value="{{ $position->id }}">{{ $position->name }}</option>
												@endforeach
											</select>
											@error('selectedPosition')<div class="invalid-feedback">{{ $message }}</div>@enderror
										</div>
										<div class="d-grid">
											<button class="btn btn-primary fs-6 fw-semibold" type="submit">
												Submit <x-users.spinners.white-btn wire:target="add" />
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<x-users.auth.image-column />
				</div>
			</div>
		</div>
	</div>
</div>

