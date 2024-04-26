<div wire:ignore.self class="modal fade" id="selectPublicationModal" tabindex="-1" aria-labelledby="selectPublicationModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="border-0 modal-header justify-content-center">
				<button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="right: 1rem; top: 1rem;"></button>
				<div class="text-center">
					<p class="p-0 m-0 text-purple-600 fs-5 fw-semibold">Select Associated Publication</p>
					<p class="p-0 m-0 text-secondary fs-6">Select who you wish to pitch to</p>
				</div>
			</div>
			<div class="modal-body">
				<div class="mb-4 input-group">
					<label class="bg-white input-group-text" for="publicationSearchInput"><i class="bi bi-search"></i></label>
					<input id="publicationSearchInput" class="shadow-none form-control border-start-0 ps-0 search-input" type="search" placeholder="Search" aria-label="Search" />
				</div>
				<hr>
				<div class="row g-3" style="max-height: 425px; overflow-y: scroll;">
					@foreach ($associatedPublications as $publication)
					<div class="col-12">
						<input type="radio" wire:model="selectedAssociatedPublication" value="{{ $publication->id }}" id="publication-{{ $publication->id }}" class="custom-radio">
						<div class="border border-2 card rounded-3">
							<label for="publication-{{ $publication->id }}">
								<div class="card-body">
									<div class="row align-items-center g-0">
										<div class="col-12">
											<div class="row align-items-center g-3">
												<div class="col-auto">
													@php
														$profileImg = $publication->profileImage ?
																		Storage::url($publication->profileImage->image_path) :
																		App\Http\Controllers\Users\AvatarController::setProfileAvatar([
																			'name' => $publication->name,
																			'width' => 50,
																			'fontSize' => 22,
																			'background' => $publication->background_color,
																			'foreground' => $publication->foreground_color,
																		], 'publication');
													@endphp
													<img class="rounded-circle img-square img-50" alt="..." src="{{ $profileImg }}" />
												</div>
												<div class="col">
													<div class="row align-items-center g-1">
														<div class="col">
															<h5 class="p-0 m-0 text-dark fs-6 fw-medium contact-title">{{ $publication->name }}</h5>
															<p class="p-0 m-0 fs-6 contact-subtitle">
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
			<div class="border-0 modal-footer justify-content-center">
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
			<div class="border-0 modal-header justify-content-center">
				<button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="right: 1rem; top: 1rem;"></button>
				<div class="text-center">
					<p class="p-0 m-0 text-purple-600 fs-5 fw-semibold">Select Contact</p>
					<p class="p-0 m-0 text-secondary fs-6">Select who you wish to pitch to</p>
				</div>
			</div>
			<div class="modal-body">
				<div class="mb-4 input-group">
					<label class="bg-white input-group-text" for="contactSearchInput"><i class="bi bi-search"></i></label>
					<input id="contactSearchInput" class="shadow-none form-control border-start-0 ps-0 search-input" type="search" placeholder="Search" aria-label="Search" />
				</div>
				<hr>
				<div class="row g-3" style="max-height: 425px; overflow-y: scroll;">
					@foreach ($journalists as $journalist)
					<div class="col-12">
						<input type="radio" wire:model="selectedJournalist" value="{{ $journalist->id }}" id="contact-{{ $journalist->id }}" class="custom-radio">
						<div class="border border-2 card rounded-3">
							<label for="contact-{{ $journalist->id }}">
								<div class="card-body">
									<div class="row align-items-center g-0">
										<div class="col-12">
											<div class="row align-items-center g-3">
												<div class="col-auto">
													@php
														$profileImg = $journalist->profileImage ?
																			Storage::url($journalist->profileImage->image_path) :
																			App\Http\Controllers\Users\AvatarController::setProfileAvatar([
																				'name' => $journalist->user->name,
																				'width' => 50,
																				'fontSize' => 22,
																				'background' => $journalist->background_color,
																				'foreground' => $journalist->foreground_color,
																			]);
													@endphp
													<img class="rounded-circle img-square img-50" alt="..." src="{{ $profileImg }}" />
												</div>
												<div class="col">
													<div class="row align-items-center g-1">
														<div class="col">
															<h5 class="p-0 m-0 text-dark fs-6 fw-medium contact-title">{{ $journalist->user->name }}</h5>
															<p class="p-0 m-0 text-secondary fs-6 contact-subtitle">{{ $journalist->position->name }}</p>
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
			<div class="border-0 modal-footer justify-content-center">
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
			<div class="border-0 modal-header justify-content-center">
				<button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="right: 1rem; top: 1rem;"></button>
				<div class="text-center">
					<p class="p-0 m-0 text-purple-600 fs-5 fw-semibold">Select Media Kit</p>
					<p class="p-0 m-0 text-secondary fs-6">Select who you wish to pitch to</p>
				</div>
			</div>
			<div class="modal-body">
				<div class="px-3">
					<div class="mb-4 input-group">
						<label class="bg-white input-group-text" for="contactSearchInput"><i class="bi bi-search"></i></label>
						<input id="contactSearchInput" class="shadow-none form-control border-start-0 ps-0 search-input" type="search" placeholder="Search" aria-label="Search" />
					</div>
				</div>
				<hr class="mx-3">
				<div class="px-3" style="max-height: 425px; overflow-y: scroll;">
					@forelse ($mediaKits as $mediaKit)
					<input type="radio" wire:model="selectedMediaKit" value="{{ $mediaKit->id }}" id="mediaKit{{ $mediaKit->id }}" class="custom-radio">
					<div class="mb-3 border border-2 card rounded-3">
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
														<h5 class="p-0 m-0 text-dark fs-6 fw-medium contact-title">{{ $mediaKit->story->title }}</h5>
														<p class="p-0 m-0 text-secondary fs-6 contact-subtitle">{{ showModelName($mediaKit->story_type) }}</p>
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
					<h5 class="text-center text-purple-700 fs-5 fw-semibold">No Media Kit Added</h5>
					@endforelse
				</div>
			</div>
			<div class="border-0 modal-footer justify-content-center">
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
			<div class="border-0 modal-header justify-content-center">
				<button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="right: 1rem; top: 1rem;"></button>
				<div class="text-center">
					<p class="p-0 m-0 text-purple-600 fs-6 fw-semibold">Write a personalised message to the journalist</p>
					<p class="p-0 m-0 text-secondary fs-6"><span class="small">Personalised messages increase your chances of getting published</span></p>
				</div>
			</div>
			<div class="modal-body">
				<div class="mb-3">
					<input type="text" class="form-control" wire:model="subject">
				</div>
				<div class="mb-3">
					<label for="inputMessage" class="form-label fw-medium">Type your message in no more than 100 words</label>
					<trix-editor input="inputMessage" x-on:trix-change="$wire.message = $event.target.value"></trix-editor>
					<input id="inputMessage" type="hidden" wire:model="message">
					{{-- <textarea wire:model="message" class="form-control" rows="12"></textarea> --}}
					{{-- Hi [Journalist Name],
						I'm writing to you about our latest story [Casa Brut] for your consideration.
						[Concept note] The site located in a rural town of Thottara, 12kms away from Mannarkkad town. Site was a contour site with a level difference of about 10m from West to East with a slope of 1:8m.
						It would be great to have it published in [Publication name]. I would be happy to share any more information that you might need.
						Regards,
						[Name] --}}
				</div>
			</div>
			<div class="border-0 modal-footer justify-content-center">
				<button type="button" class="px-3 btn btn-primary"  wire:click="showPitchSuccess">
					Send Message {{-- <i class="bi bi-send-fill"></i> --}}<x-users.spinners.white-btn />
				</button>
			</div>
		</div>
	</div>
</div>

<div wire:ignore.self class="modal fade" id="pitchPublicationSuccessModal" tabindex="-1" aria-labelledby="pitchSuccessLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="border-0 modal-header justify-content-center">
				<button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="right: 1rem; top: 1rem;"></button>
			</div>
			<div class="modal-body">
				<div class="py-2 border d-flex justify-content-center align-items-center rounded-3">
					<h4 class="m-0 text-center text-purple-900 fs2 fw-semibold">Your story has been<br>successfully submitted.</h4>
				</div>
			</div>
			<div class="border-0 modal-footer justify-content-center">
				<a href="{{ route('architect.pitch-story.publications.index') }}" class="px-3 btn btn-primary">
					Pitch to another Publication <i class="bi bi-send-fill"></i>
				</a>
			</div>
		</div>
	</div>
</div>

<div wire:ignore.self class="modal fade" id="pitchJournalistSuccessModal" tabindex="-1" aria-labelledby="pitchSuccessLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="border-0 modal-header justify-content-center">
				<button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="right: 1rem; top: 1rem;"></button>
			</div>
			<div class="modal-body">
				<div class="py-2 border d-flex justify-content-center align-items-center rounded-3">
					<h4 class="m-0 text-center text-purple-900 fs2 fw-semibold">Your story has been<br>successfully submitted.</h4>
				</div>
			</div>
			<div class="border-0 modal-footer justify-content-center">
				<a href="{{ route('architect.pitch-story.journalists.index') }}" class="px-3 btn btn-primary">
					Pitch to another Journalist <i class="bi bi-send-fill"></i>
				</a>
			</div>
		</div>
	</div>
</div>

<div wire:ignore.self class="modal fade" id="pitchCallSuccessModal" tabindex="-1" aria-labelledby="pitchSuccessLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="border-0 modal-header justify-content-center">
				<button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close" style="right: 1rem; top: 1rem;"></button>
			</div>
			<div class="modal-body">
				<div class="py-2 border d-flex justify-content-center align-items-center rounded-3">
					<h4 class="m-0 text-center text-purple-900 fs2 fw-semibold">Your story has been<br>successfully submitted.</h4>
				</div>
			</div>
			<div class="border-0 modal-footer justify-content-center">
				<a href="{{ route('architect.pitch-story.calls.index') }}" class="px-3 btn btn-primary">
					Pitch to another Call <i class="bi bi-send-fill"></i>
				</a>
			</div>
		</div>
	</div>
</div>

<div wire:ignore.self class="modal fade" id="pitchCallPremiumAlertModal" tabindex="-1" aria-labelledby="pitchCallPremiumAlertLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<div class="py-2 text-center">
					<h4 class="text-purple-700 fs-4 fw-semibold">Premium Publication</h4>
					<p class="text-secondary">Please upgrade your account to pitch to premium publications. Unlock unlimited pitches to a wide range of publications and enjoy many more features with a premium account.</p>
					<p>
						<a href="{{ route('pricing') }}" class="btn btn-primary fw-medium" style="width: 150px;">Upgrade</a>
					</p>
					<p class="m-0">
						<button type="button" class="btn btn-secondary fw-medium" data-bs-dismiss="modal" aria-label="Close" style="width: 150px;">Return</button>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>

