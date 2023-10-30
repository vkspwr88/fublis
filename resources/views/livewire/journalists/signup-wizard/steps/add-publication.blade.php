<div>
	@include('livewire.journalists.signup-wizard.navigation')

	<div class="row bg-white justify-content-center pt-5">
		<div class="col-lg-10">
			<div class="card rounded-4 shadow border border-1">
				<div class="row g-0 {{-- align-items-center --}}">
					<div class="col-md-6">
						<div class="row justify-content-between align-items-center">
							<div class="col-12">
								<div class="card-body px-5">
									<form class="py-3" wire:submit="add">
										@if($new)
											<div class="mb-3">
												<label for="inputPublicationName" class="form-label text-dark fs-6 fw-medium">Search for your Publication</label>
												<input type="text" class="form-control  @error('publicationName') is-invalid @enderror" id="inputPublicationName" placeholder="Name of your brand / studio" wire:model.live="publicationName">
												@error('publicationName')<div class="invalid-feedback">{{ $message }}</div>@enderror
											</div>
											<div class="mb-3">
												<label for="inputWebsite" class="form-label text-dark fs-6 fw-medium">Website</label>
												<div class="input-group">
													<span class="input-group-text bg-white" id="basic-addon1">http://</span>
													<input type="text" class="form-control @error('website') is-invalid @enderror" id="inputWebsite" placeholder="www.your-website.com" aria-label="Username" aria-describedby="basic-addon1" wire:model="website">
													@error('website')<div class="invalid-feedback">{{ $message }}</div>@enderror
												</div>
											</div>
											<div class="mb-3">
												<label for="selectLocation" class="form-label text-dark fs-6 fw-medium">Location</label>
												<select class="form-select @error('location') is-invalid @enderror" id="selectLocation" wire:model="location">
													<option value="">Select Location</option>
													@foreach ($locations as $location)
													<option value="{{ $location->id }}">{{ $location->name }}</option>
													@endforeach
												</select>
												@error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
												<label class="form-label text-dark fs-6 fw-medium">Category</label>
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
													<div id="searchBox" class="border rounded-3 p-3" style="height: 10.25rem; overflow-y: scroll;">
														<div class="row">
															@forelse ($publications as $publication)
																<div class="col-12">
																	<input id="{{ $publication->id }}" type="radio" value="{{ $publication->id }}" wire:model="selectedPublication">
																	<div class="search-list position-relative p-2 my-1">
																		<label for="{{ $publication->id }}" class="text-secondary fs-6 w-100">
																			<span class="fw-bold text-dark">{{ $publication->name }}</span>
																			<span>{{ $publication->location->name }}</span>
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
															{{-- <div class="col-12">
																<input id="radio2" type="radio" value="2" wire:model="selectedPublication">
																<div class="search-list position-relative p-2 my-1">
																	<label for="radio2" class="text-secondary fs-6 w-100">
																		<span class="fw-bold text-dark">Rethinking The Future</span>
																		<span>Worldwide</span>
																		<span class="checked position-absolute text-purple-600">
																			<i class="bi bi-check-lg"></i>
																		</span>
																	</label>
																</div>
															</div>
															<div class="col-12">
																<input id="radio3" type="radio" value="3" wire:model="selectedPublication">
																<div class="search-list position-relative p-2 my-1">
																	<label for="radio3" class="text-secondary fs-6 w-100">
																		<span class="fw-bold text-dark">Rethinking The Life</span>
																		<span>Worldwide</span>
																		<span class="checked position-absolute text-purple-600">
																			<i class="bi bi-check-lg"></i>
																		</span>
																	</label>
																</div>
															</div> --}}
														</div>
													</div>
												</div>
												<div class="mb-3">
													<a href="javascript:;" class="text-secondary" wire:click="$set('new', true)">Can't find?</a>
												</div>
											@endif
										@endif
										<div class="d-grid">
											<button class="btn btn-primary fs-6 fw-semibold" type="submit">Submit</button>
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

