<div wire:ignore.self class="modal fade" id="selectPublicationModal" tabindex="-1" aria-labelledby="selectPublicationModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header justify-content-center border-0">
				<button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="right: 1rem; top: 1rem;"></button>
				<div class="text-center">
					<p class="text-purple-600 fs-5 fw-semibold m-0 p-0">Select Associated Publication</p>
					<p class="text-secondary fs-6 m-0 p-0">Select who you wish to pitch to</p>
				</div>
			</div>
			<div class="modal-body">
				<div class="input-group mb-4">
					<label class="input-group-text bg-white" for="publicationSearchInput"><i class="bi bi-search"></i></label>
					<input id="publicationSearchInput" class="form-control border-start-0 shadow-none ps-0 search-input" type="search" placeholder="Search" aria-label="Search" />
				</div>
				<hr>
				<div class="row g-3" style="max-height: 425px; overflow-y: scroll;">
					@foreach ($associatedPublications as $publication)
					<div class="col-12">
						<input type="radio" wire:model="selectedAssociatedPublication" value="{{ $publication->id }}" id="publication-{{ $publication->id }}" class="custom-radio">
						<div class="card rounded-3 border border-2">
							<label for="publication-{{ $publication->id }}">
								<div class="card-body">
									<div class="row align-items-center g-0">
										<div class="col-12">
											<div class="row align-items-center g-3">
												<div class="col-auto">
													<img class="rounded-circle img-square img-50" alt="..." src="{{ $publication->profileImage ? Storage::url($publication->profileImage->image_path) : 'https://via.placeholder.com/50x50' }}" />
												</div>
												<div class="col">
													<div class="row align-items-center g-1">
														<div class="col">
															<h5 class="text-dark fs-6 fw-medium m-0 p-0 contact-title">{{ $publication->name }}</h5>
															<p class="fs-6 m-0 p-0 contact-subtitle">
																<a href="{{ $publication->website }}" class="text-secondary small" target="_blank">
																	{{ trimWebsiteUrl($publication->website) }}
																</a>
															</p>
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
					</div>
					@endforeach
				</div>
			</div>
			<div class="modal-footer justify-content-center border-0">
				<button type="button" class="btn btn-primary" style="width: 120px;" wire:click="showMediaKit">
					Next <x-users.spinners.white-btn />
				</button>
			</div>
		</div>
	</div>
</div>

<div wire:ignore.self class="modal fade" id="selectContactModal" tabindex="-1" aria-labelledby="selectContactModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
				<div class="input-group mb-4">
					<label class="input-group-text bg-white" for="contactSearchInput"><i class="bi bi-search"></i></label>
					<input id="contactSearchInput" class="form-control border-start-0 shadow-none ps-0 search-input" type="search" placeholder="Search" aria-label="Search" />
				</div>
				<hr>
				<div class="row g-3" style="max-height: 425px; overflow-y: scroll;">
					@foreach ($journalists as $journalist)
					<div class="col-12">
						<input type="radio" wire:model="selectedJournalist" value="{{ $journalist->id }}" id="contact-{{ $journalist->id }}" class="custom-radio">
						<div class="card rounded-3 border border-2">
							<label for="contact-{{ $journalist->id }}">
								<div class="card-body">
									<div class="row align-items-center g-0">
										<div class="col-12">
											<div class="row align-items-center g-3">
												<div class="col-auto">
													<img class="rounded-circle img-square img-50" alt="..." src="{{ $journalist->profileImage ? Storage::url($journalist->profileImage->image_path) : 'https://via.placeholder.com/50x50' }}" />
												</div>
												<div class="col">
													<div class="row align-items-center g-1">
														<div class="col">
															<h5 class="text-dark fs-6 fw-medium m-0 p-0 contact-title">{{ $journalist->user->name }}</h5>
															<p class="text-secondary fs-6 m-0 p-0 contact-subtitle">{{ $journalist->position->name }}</p>
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
					</div>
					@endforeach
				</div>
			</div>
			<div class="modal-footer justify-content-center border-0">
				<button type="button" class="btn btn-primary" style="width: 120px;" wire:click="showMediaKit">
					Next <x-users.spinners.white-btn />
				</button>
			</div>
		</div>
	</div>
</div>

<div wire:ignore.self class="modal fade" id="selectMediaKitModal" tabindex="-1" aria-labelledby="selectMediaKitModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
					@forelse ($mediaKits as $mediaKit)
					<input type="radio" wire:model="selectedMediaKit" value="{{ $mediaKit->id }}" id="mediaKit{{ $mediaKit->id }}" class="custom-radio">
					<div class="card rounded-3 border border-2 mb-3">
						<label for="mediaKit{{ $mediaKit->id }}">
							<div class="card-body">
								<div class="row align-items-center g-0">
										<div class="col-12">
											<div class="row align-items-center g-3">
											<div class="col-auto">
												<img class="rounded-circle img-square img-50" alt="..." src="{{ Storage::url($mediaKit->story->cover_image_path) }}" />
											</div>
												<div class="col">
													<div class="row align-items-center g-1">
														<div class="col">
														<h5 class="text-dark fs-6 fw-medium m-0 p-0 contact-title">{{ $mediaKit->story->title }}</h5>
														<p class="text-secondary fs-6 m-0 p-0 contact-subtitle">{{ showModelName($mediaKit->story_type) }}</p>
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
					@empty
					<h5 class="fs-5 text-center text-purple-700 fw-semibold">No Media Kit Added</h5>
					@endforelse
				</div>
			</div>
			<div class="modal-footer justify-content-center border-0">
				<button type="button" class="btn btn-primary" style="width: 120px;" wire:click="showSendMessage">
					Next <x-users.spinners.white-btn />
				</button>
			</div>
		</div>
	</div>
</div>

<div wire:ignore.self class="modal fade" id="sendMessageModal" tabindex="-1" aria-labelledby="sendMessageModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header justify-content-center border-0">
				<button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="right: 1rem; top: 1rem;"></button>
				<div class="text-center">
					<p class="text-purple-600 fs-6 fw-semibold m-0 p-0">Write a personalised message to the journalist</p>
					<p class="text-secondary fs-6 m-0 p-0"><span class="small">Personalised messages increase your chances of getting published</span></p>
				</div>
			</div>
			<div class="modal-body">
				<div class="mb-3">
					<input type="text" class="form-control" wire:model="subject">
				</div>
				<div class="mb-3">
					<label for="input" class="form-label fw-medium">Type your message in no more than 100 words</label>
					<textarea wire:model="message" class="form-control" rows="12"></textarea>
					{{-- Hi [Journalist Name],
						I'm writing to you about our latest story [Casa Brut] for your consideration.
						[Concept note] The site located in a rural town of Thottara, 12kms away from Mannarkkad town. Site was a contour site with a level difference of about 10m from West to East with a slope of 1:8m.
						It would be great to have it published in [Publication name]. I would be happy to share any more information that you might need.
						Regards,
						[Name] --}}
				</div>
			</div>
			<div class="modal-footer justify-content-center border-0">
				<button type="button" class="btn btn-primary px-3"  wire:click="showPitchSuccess">
					Send Message {{-- <i class="bi bi-send-fill"></i> --}}<x-users.spinners.white-btn />
				</button>
			</div>
		</div>
	</div>
</div>

<div wire:ignore.self class="modal fade" id="pitchPublicationSuccessModal" tabindex="-1" aria-labelledby="pitchSuccessLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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

<div wire:ignore.self class="modal fade" id="pitchJournalistSuccessModal" tabindex="-1" aria-labelledby="pitchSuccessLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
				<a href="{{ route('architect.pitch-story.journalists.index') }}" class="btn btn-primary px-3">
					Pitch to another Journalist <i class="bi bi-send-fill"></i>
				</a>
			</div>
		</div>
	</div>
</div>

<div wire:ignore.self class="modal fade" id="pitchCallSuccessModal" tabindex="-1" aria-labelledby="pitchSuccessLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
				<a href="{{ route('architect.pitch-story.calls.index') }}" class="btn btn-primary px-3">
					Pitch to another Call <i class="bi bi-send-fill"></i>
				</a>
			</div>
		</div>
	</div>
</div>

