<div class="row">
	<div class="col-lg-4">
		<div class="filter-btn text-end pb-3">
			<button class="btn btn-primary rounded-0" data-bs-toggle="collapse" data-bs-target="#collapsedFilter" aria-expanded="false" aria-controls="collapsedFilter">
				<i class="bi bi-filter"></i>
			</button>
		</div>
		<div class="position-relative">
			<div class="filter-container" id="collapsedFilter">
				<form wire:submit="search">
					@include('users.includes.architect.pitch-story-nav-types', ['type' => 'publication'])
					<div class="input-group mb-4">
						<label class="input-group-text bg-white" for="filterSearchInput"><i class="bi bi-search"></i></label>
						<input id="filterSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search by name" aria-label="Search" />
					</div>
					<x-users.filter.header text="Location" />
					<x-users.filter.select type="location" :list="$locations" model="selectedLocation" />
					<hr class="divider">
					<x-users.filter.header text="Publication Types" />
					<x-users.filter.checkbox-list type="publication-type" :list="$publicationTypes" model="selectedPubliationTypes" />
					<hr class="divider">
					<x-users.filter.header text="Categories" />
					<x-users.filter.checkbox-list type="category" :list="$categories" model="selectedCategories" />
					<hr class="divider">
					<div class="d-grid">
						<button type="submit" class="btn btn-white text-capitalize">search</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-8">
		<div class="row g-4">
			@foreach ($publications as $publication)
			<div class="col-12">
				<div class="card border-0 rounded-3 bg-white shadow">
					<div class="card-body">
						<div class="row gx-2 gy-4">
							<div class="col-sm-3">
								<div class="d-block mx-auto text-center">
									<img src="{{ $publication->profileImage ? Storage::url($publication->profileImage->image_path) : 'https://via.placeholder.com/150x150' }}" style="max-width: 150px; max-height: 150px;" class="img-fluid" alt="...">
								</div>
							</div>
							<div class="col-sm-9">
								<div class="row align-items-center pb-2">
									<p class="fs-6 col m-0">
										<span class="badge rounded-pill text-bg-secondary mb-1"><i class="bi bi-geo-alt"></i> {{ $publication->location->name }}</span>
										<span class="badge rounded-pill text-bg-secondary mb-1">Website</span>
										<span class="badge rounded-pill text-bg-secondary mb-1">English</span>
									</p>
									<p class="text-end fs-6 col m-0">
										<button type="button" class="btn btn-primary fw-medium" data-bs-toggle="modal" data-bs-target="#selectContactModal">Pitch Story</button>
									</p>
								</div>
								<div class="row justify-content-end align-items-end g-4">
									<div class="col-md-4">
										<div class="row justify-content-center">
											<div class="col-12">
												<p class="fw-medium m-0 py-2">
													<span class="badge rounded-pill bg-purple-50 text-purple-700">23.3K monthly visits</span>
												</p>
											</div>
											<div class="col-12">
												<h5 class="fs-5 fw-semibold m-0 pt-3">
													<a href="{{ route('architect.pitch-story.publications.view', ['id' => 'id']) }}" class="text-dark">
														{{ $publication->name }}
													</a>
												</h5>
												<p class="fs-6 m-0 p-0">
													<a href="{{ $publication->website }}" class="text-secondary small" target="_blank">
														{{ trimWebsiteUrl($publication->website) }}
													</a>
												</p>
											</div>
										</div>
									</div>
									<div class="col-md-8">
										<div class="d-flex justify-content-end align-items-center flex-wrap fw-medium">
											@foreach ($publication->categories as $category)
												<span class="badge rounded-pill bg-purple-50 text-purple-700">{{ $category->name }}</span>
											@endforeach
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>


	<div class="modal fade" id="selectContactModal" tabindex="-1" aria-labelledby="selectContactModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header justify-content-center border-0">
					<button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="right: 1rem; top: 1rem;"></button>
					<div class="text-center">
						<p class="text-purple-600 fs-5 fw-semibold m-0 p-0">Select Contact</p>
						<p class="text-secondary fs-6 m-0 p-0">Select who you wish to pitch to</p>
					</div>
				</div>
				<div class="modal-body">
					<div class="px-3">
						<div class="input-group mb-4">
							<label class="input-group-text bg-white" for="contactSearchInput"><i class="bi bi-search"></i></label>
							<input id="contactSearchInput" class="form-control border-start-0 shadow-none ps-0 search-input" type="search" placeholder="Search" aria-label="Search" />
						</div>
					</div>
					<hr class="mx-3">
					<div class="px-3" style="max-height: 425px; overflow-y: scroll;">
						@for ($i=1; $i<=5; $i++)
						<input type="radio" name="pitchContact" id="contact{{ $i }}" class="custom-radio">
						<div class="card rounded-3 border border-2 {{ ($i != 5) ? 'mb-3' : '' }}">
							<label for="contact{{ $i }}">
								<div class="card-body">
									<div class="row align-items-center g-0">
										<div class="col-12">
											<div class="row align-items-center g-3">
												<div class="col-auto">
													<img class="rounded-circle img-fluid" alt="..." src="https://via.placeholder.com/50x50" />
												</div>
												<div class="col">
													<div class="row align-items-center g-1">
														<div class="col">
														<h5 class="text-dark fs-6 fw-medium m-0 p-0 contact-title">Stefan Stefancik</h5>
														<p class="text-secondary fs-6 m-0 p-0 contact-subtitle">Editor</p>
														</div>
														<div class="col-auto">
															<div class="fublis-radio rounded-circle">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<path fill-rule="evenodd" clip-rule="evenodd" d="M17.0965 7.38967L9.9365 14.2997L8.0365 12.2697C7.6865 11.9397 7.1365 11.9197 6.7365 12.1997C6.3465 12.4897 6.2365 12.9997 6.4765 13.4097L8.7265 17.0697C8.9465 17.4097 9.3265 17.6197 9.7565 17.6197C10.1665 17.6197 10.5565 17.4097 10.7765 17.0697C11.1365 16.5997 18.0065 8.40967 18.0065 8.40967C18.9065 7.48967 17.8165 6.67967 17.0965 7.37967V7.38967Z" fill="white"/>
																</svg>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</label>
						</div>
						@endfor
					</div>
				</div>
				<div class="modal-footer justify-content-center border-0">
					<button type="button" class="btn btn-primary" style="width: 120px;" data-bs-target="#selectMediaKitModal" data-bs-toggle="modal">Next</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="selectMediaKitModal" tabindex="-1" aria-labelledby="selectMediaKitModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header justify-content-center border-0">
					<button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="right: 1rem; top: 1rem;"></button>
					<div class="text-center">
						<p class="text-purple-600 fs-5 fw-semibold m-0 p-0">Select Media Kit</p>
						<p class="text-secondary fs-6 m-0 p-0">Select who you wish to pitch to</p>
					</div>
				</div>
				<div class="modal-body">
					<div class="px-3">
						<div class="input-group mb-4">
							<label class="input-group-text bg-white" for="contactSearchInput"><i class="bi bi-search"></i></label>
							<input id="contactSearchInput" class="form-control border-start-0 shadow-none ps-0 search-input" type="search" placeholder="Search" aria-label="Search" />
						</div>
					</div>
					<hr class="mx-3">
					<div class="px-3" style="max-height: 425px; overflow-y: scroll;">
						<input type="radio" name="mediaKitInput" id="mediaKit0" class="custom-radio">
						<div class="card rounded-3 border border-2 mb-3">
							<label for="mediaKit0">
								<div class="card-body">
									<div class="row align-items-center g-0">
											<div class="col-12">
												<div class="row align-items-center g-3">
												<div class="col-auto">
													<img class="rounded-circle img-fluid" alt="..." src="https://via.placeholder.com/50x50" />
												</div>
													<div class="col">
														<div class="row align-items-center g-1">
															<div class="col">
															<h5 class="text-dark fs-6 fw-medium m-0 p-0 contact-title">The House of Things Launches IRA Udaipur - A new luxury product lifestyle product label that celebrates Architecture and its beauty</h5>
															<p class="text-secondary fs-6 m-0 p-0 contact-subtitle">Press Release</p>
															</div>
															<div class="col-auto">
															<div class="fublis-radio rounded-circle">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<path fill-rule="evenodd" clip-rule="evenodd" d="M17.0965 7.38967L9.9365 14.2997L8.0365 12.2697C7.6865 11.9397 7.1365 11.9197 6.7365 12.1997C6.3465 12.4897 6.2365 12.9997 6.4765 13.4097L8.7265 17.0697C8.9465 17.4097 9.3265 17.6197 9.7565 17.6197C10.1665 17.6197 10.5565 17.4097 10.7765 17.0697C11.1365 16.5997 18.0065 8.40967 18.0065 8.40967C18.9065 7.48967 17.8165 6.67967 17.0965 7.37967V7.38967Z" fill="white"/>
																</svg>
															</div>
														</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
							</label>
						</div>
						@for ($i=1; $i<=5; $i++)
						<input type="radio" name="mediaKitInput" id="mediaKit{{ $i }}" class="custom-radio">
						<div class="card rounded-3 border border-2 {{ ($i != 5) ? 'mb-3' : '' }}">
							<label for="mediaKit{{ $i }}">
								<div class="card-body">
									<div class="row align-items-center g-0">
											<div class="col-12">
												<div class="row align-items-center g-3">
												<div class="col-auto">
													<img class="rounded-circle img-fluid" alt="..." src="https://via.placeholder.com/50x50" />
												</div>
													<div class="col">
														<div class="row align-items-center g-1">
															<div class="col">
															<h5 class="text-dark fs-6 fw-medium m-0 p-0 contact-title">Casa Brut</h5>
															<p class="text-secondary fs-6 m-0 p-0 contact-subtitle">Project</p>
															</div>
															<div class="col-auto">
															<div class="fublis-radio rounded-circle">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<path fill-rule="evenodd" clip-rule="evenodd" d="M17.0965 7.38967L9.9365 14.2997L8.0365 12.2697C7.6865 11.9397 7.1365 11.9197 6.7365 12.1997C6.3465 12.4897 6.2365 12.9997 6.4765 13.4097L8.7265 17.0697C8.9465 17.4097 9.3265 17.6197 9.7565 17.6197C10.1665 17.6197 10.5565 17.4097 10.7765 17.0697C11.1365 16.5997 18.0065 8.40967 18.0065 8.40967C18.9065 7.48967 17.8165 6.67967 17.0965 7.37967V7.38967Z" fill="white"/>
																</svg>
															</div>
														</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
							</label>
						</div>
						@endfor
					</div>
				</div>
				<div class="modal-footer justify-content-center border-0">
					<button type="button" class="btn btn-primary" style="width: 120px;" data-bs-target="#sendMessageModal" data-bs-toggle="modal">Next</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="sendMessageModal" tabindex="-1" aria-labelledby="sendMessageModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header justify-content-center border-0">
					<button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="right: 1rem; top: 1rem;"></button>
					<div class="text-center">
						<p class="text-purple-600 fs-5 fw-semibold m-0 p-0">Write a personalised message to the journalist</p>
						<p class="text-secondary fs-6 m-0 p-0"><span class="small">Personalised messages increase your chances of getting published</span></p>
					</div>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<input type="text" class="form-control" id="exampleInputEmail1" value="New Project | Casa Brut">
					</div>
					<div class="mb-3">
						<label for="input" class="form-label fw-medium">Type your message in no more than 100 words</label>
						<textarea name="" id="" class="form-control" rows="12">
							Hi [Journalist Name],
							I'm writing to you about our latest story [Casa Brut] for your consideration.
							[Concept note] The site located in a rural town of Thottara, 12kms away from Mannarkkad town. Site was a contour site with a level difference of about 10m from West to East with a slope of 1:8m.
							It would be great to have it published in [Publication name]. I would be happy to share any more information that you might need.
							Regards,
							[Name]
						</textarea>
					</div>
				</div>
				<div class="modal-footer justify-content-center border-0">
					<button type="button" class="btn btn-primary px-3" data-bs-target="#pitchSuccessModal" data-bs-toggle="modal">
						Send Message <i class="bi bi-send-fill"></i>
					</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="pitchSuccessModal" tabindex="-1" aria-labelledby="pitchSuccessLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header justify-content-center border-0">
					<button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="right: 1rem; top: 1rem;"></button>
				</div>
				<div class="modal-body">
					<div class="d-flex justify-content-center align-items-center border rounded-3 py-2">
						<h4 class="fs2 text-purple-900 text-center fw-semibold m-0">Your story has been<br>successfully submitted.</h4>
					</div>
				</div>
				<div class="modal-footer justify-content-center border-0">
					<a href="{{ route('architect.pitch-story.publications.index') }}" class="btn btn-primary px-3">
						Pitch to another Publication <i class="bi bi-send-fill"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
