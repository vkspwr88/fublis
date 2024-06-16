<div>
	@include('livewire.journalists.signup-wizard.navigation')

	<div class="pt-5 bg-white row justify-content-center">
		<div class="col-lg-10">
			<div class="border shadow card rounded-4 border-1">
				<div class="row g-0 align-items-start">
					<div class="col-sm-12 col-md-6">
						<div class="row justify-content-between align-items-center">
							<div class="col-12">
								<div class="px-5 card-body">
									<form class="py-3" wire:submit="add">
										@if($new)
											<div class="mb-3">
												<label for="inputPublicationName" class="form-label text-dark fs-6 fw-medium">Enter your Publication</label>
												<input type="text" class="form-control  @error('publicationName') is-invalid @enderror" id="inputPublicationName" placeholder="Enter publication name" wire:model="publicationName">
												@error('publicationName')<div class="invalid-feedback">{{ $message }}</div>@enderror
											</div>
											<div class="mb-3">
												<label for="inputWebsite" class="form-label text-dark fs-6 fw-medium">Website</label>
												<input type="text" class="form-control @error('website') is-invalid @enderror" id="inputWebsite" placeholder="www.your-website.com" aria-label="Username" aria-describedby="basic-addon1" wire:model="website">
												@error('website')<div class="invalid-feedback">{{ $message }}</div>@enderror
											</div>
											<div class="mb-3">
												<label for="selectCountry" class="form-label text-dark fs-6 fw-medium">Country</label>
												<select class="form-select @error('selectedCountry') is-invalid @enderror" id="selectCountry" wire:model="selectedCountry">
													<option value="0">Select Country</option>
													@foreach ($countries as $country)
													<option value="{{ $country->name }}">{{ str()->headline($country->name) }}</option>
													@endforeach
												</select>
												@error('selectedCountry')<div class="invalid-feedback">{{ $message }}</div>@enderror
											</div>
											{{-- <div class="mb-3">
												<label for="selectState" class="form-label text-dark fs-6 fw-medium">State</label>
												<select class="form-select @error('selectedState') is-invalid @enderror" id="selectState" wire:model.live="selectedState">
													<option value="0">Select State</option>
													@foreach ($states as $state)
													<option value="{{ $state->id }}">{{ str()->headline($state->name) }}</option>
													@endforeach
												</select>
												@error('selectedState')<div class="invalid-feedback">{{ $message }}</div>@enderror
											</div> --}}
											{{-- <div class="mb-3">
												<label for="selectCity" class="form-label text-dark fs-6 fw-medium">City</label>
												<select class="form-select @error('selectedCity') is-invalid @enderror" id="selectCity" wire:model="selectedCity">
													<option value="">Select City</option>
													@foreach ($cities as $city)
													<option value="{{ $city->name }}">{{ str()->headline($city->name) }}</option>
													@endforeach
												</select>
												@error('selectedCity')<div class="invalid-feedback">{{ $message }}</div>@enderror
											</div> --}}
											<div class="mb-3">
												<label class="form-label text-dark fs-6 fw-medium">Language</label>
												<div class="row">
													@foreach ($languages as $language)
													<div class="col-6">
														<div class="form-check">
															<input class="form-check-input" type="checkbox" value="{{ $language->id }}" id="language-{{ $language->id }}" wire:model="checkedLanguage">
															<label class="form-check-label" for="language-{{ $language->id }}">{{ $language->name }}</label>
														</div>
													</div>
													@endforeach
												</div>
												@error('checkedLanguage')<div class="error">{{ $message }}</div>@enderror
											</div>
											<div class="mb-3">
												<label class="form-label text-dark fs-6 fw-medium">Publish Stories From</label>
												<div class="row">
													@foreach ($publishFrom as $publish)
													<div class="col-6">
														<div class="form-check">
															<input class="form-check-input" type="checkbox" value="{{ $publish->id }}" id="publish-{{ $publish->id }}" wire:model="checkedPublishFrom">
															<label class="form-check-label" for="publish-{{ $publish->id }}">{{ $publish->name }}</label>
														</div>
													</div>
													@endforeach
												</div>
												@error('checkedPublishFrom')<div class="error">{{ $message }}</div>@enderror
											</div>
											<div class="mb-3">
												<label class="form-label text-dark fs-6 fw-medium">Publication Type</label>
												<div class="row">
													@foreach ($publicationTypes as $publicationType)
													<div class="col-6">
														<div class="form-check">
															<input class="form-check-input" type="checkbox" value="{{ $publicationType->id }}" id="pub-{{ $publicationType->id }}" wire:model="checkedPublicationTypes">
															<label class="form-check-label" for="pub-{{ $publicationType->id }}">{{ $publicationType->name }}</label>
														</div>
													</div>
													@endforeach
												</div>
												@error('checkedPublicationTypes')<div class="error">{{ $message }}</div>@enderror
											</div>
											<div class="mb-3">
												<label for="" class="form-label text-dark fs-6 fw-medium">Category</label>
												<div class="row">
													@foreach ($categories as $category)
													<div class="col-6">
														<div class="form-check">
															<input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="cat-{{ $category->id }}" wire:model="checkedCategories">
															<label class="form-check-label" for="cat-{{ $category->id }}">{{ $category->name }}</label>
														</div>
													</div>
													@endforeach
												</div>
												@error('checkedCategories')<div class="error">{{ $message }}</div>@enderror
											</div>
										@else
											<div class="mb-3">
												<label for="searchPublicationName" class="form-label text-dark fs-6 fw-medium">Search for your Publication</label>
												<input type="text" class="form-control  @error('publicationName') is-invalid @enderror" id="searchPublicationName" placeholder="Enter publication name" wire:model.live.debounce.250ms="searchPublicationName">
												@error('selectedPublication')<div class="error">{{ $message }}</div>@enderror
											</div>
											@if($showList)
												<div class="mb-3">
													<div id="searchBox" class="p-3 border rounded-3" style="height: 10.25rem; overflow-y: scroll;">
														<div class="row">
															@forelse ($publications as $publication)
																<div class="col-12">
																	<input id="{{ $publication->id }}" type="radio" value="{{ $publication->id }}" wire:model="selectedPublication">
																	<div class="p-2 my-1 search-list position-relative">
																		<label for="{{ $publication->id }}" class="text-secondary fs-6 w-100">
																			<span class="fw-bold text-dark">{{ $publication->name }}</span>
																			<span>{{ $publication->location->name }}</span>
																			<span class="text-purple-600 checked position-absolute">
																				<i class="bi bi-check-lg"></i>
																			</span>
																		</label>
																	</div>
																</div>
															@empty
																<div class="col-12">
																	<div class="p-2 my-1 search-list position-relative">
																		No Result Found
																	</div>
																</div>
															@endforelse
														</div>
													</div>
												</div>
												<div class="mb-3">
													<p class="m-0 text-secondary">
														Can't find?
														<a href="javascript:;" class="ms-1 btn btn-sm btn-primary fs-6 fw-semibold rounded-pill text-capitalize" wire:click="setNew">
															add your publication <x-users.spinners.white-btn wire:target="setNew" />
														</a>
													</p>
												</div>
											@endif
										@endif
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
					<x-users.auth.image-column :src="asset('images/signup/fublis-stretch.png')" />
				</div>
			</div>
		</div>
	</div>
</div>

