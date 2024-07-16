<form wire:submit="submit">
	<div class="row g-4">
		<div class="col-md-12 text-end">
			<button class="btn btn-white fs-6 fw-semibold" type="button" wire:click="draft">
				Save Draft <x-users.spinners.primary-btn wire:target="draft" />
			</button>
			<button class="btn btn-primary fs-6 fw-semibold ms-2" type="submit">
				Submit Interview <x-users.spinners.white-btn wire:target="submit" />
			</button>
		</div>

		<div class="col-md-12">
			@include('users.includes.utilities.alerts.error')
			<div class="row g-4">
				@foreach ($interview->interviewQuestions as $question)
					<div class="col-md-12" wire:key="quest{{ $question->id }}">
						<div class="row g-3">
							<div class="col-md-12">
								<div class="row g-3">
									<div class="col-auto" style="width: 50px;">
										<img src="{{ asset('images/logo/quest_icon.png') }}" alt=".." class="img-square img-32" />
									</div>
									<div class="text-purple-800 col fw-semibold fs-6">
										{{ $question->question }}
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="row g-3">
									<div class="col-auto fw-semibold text-dark" style="width: 50px;">
										<label for="answer{{ $loop->index }}">You:</label>
									</div>
									<div class="col">
										<textarea id="answer{{ $loop->index }}" class="form-control @error('answers.{{ $question->id }}') is-invalid @enderror" rows="5" placeholder="Write your answer..." wire:model="answers.{{ $question->id }}"></textarea>
										@error('answers.{{ $question->id }}')<div class="error">{{ $message }}</div>@enderror
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>

		<hr class="border-gray-300">

		<div class="col-md-12">
			<div class="row g-3">
				<div class="col-md-2">
					<label for="coverImage" class="col-form-label text-dark fs-6 fw-medium">Your profile</label>
					<label for="" class="m-0 d-block form-text text-secondary fs-7">Choose the best high-resolution image</label>
				</div>
				<div class="col-md-10">
					<div class="card">
						<div class="bg-white border card-body rounded-3 border-light">
							<div class="row align-items-center g-4">
								<div class="col-12" x-data="fileUpload('profile_pic_path')">
									<div
										x-on:drop="isDropping = false"
										x-on:drop.prevent="handleCropFileDrop($event)"
										x-on:dragover.prevent="isDropping = true"
										x-on:dragleave.prevent="isDropping = false"
									>
										<div class="top-0 bottom-0 z-30 flex opacity-75 position-absolute start-0 end-0 justify-content-center align-items-center bg-primary rounded-2" x-show="isDropping" style="display: none;">
											<span class="text-white fs-4">Release file to upload!</span>
										</div>
										<div class="d-flex justify-content-center align-items-center">
											<div class="text-gray-600 upload-icon rounded-circle fs-5">
												<i class="bi bi-cloud-upload"></i>
											</div>
										</div>
										<p class="py-2 m-0 text-center card-text text-secondary fs-6">
											<label for="coverImage"><span class="text-purple-700 cursor-pointer fw-semibold">Click to upload</span></label> or drag and drop
										</p>
										<input type="file" id="coverImage" class="d-none" @change="handleCropFileSelect">
										<p class="py-2 m-0 text-center card-text text-secondary fs-6">{{ __('text.profileImage') }}</p>
										@if($profile_pic_path)
											<ul class="p-0 mt-3 text-center" style="list-style: none;">
												@if(method_exists($profile_pic_path, 'temporaryUrl'))
													<li>
														<img class="img-fluid img-thumbnail" src="{{ $profile_pic_path->temporaryUrl() }}" alt="">
													</li>
													<li class="mt-2">
														<button type="button" class="btn btn-primary fs-6 fw-medium" @click="removeUpload('{{ $profile_pic_path->getFilename() }}')">Remove</button>
													</li>
												@else
													<li>
														<img class="img-fluid img-thumbnail" src="{{ Storage::url($profile_pic_path) }}" alt="">
													</li>
												@endif
											</ul>
										@endif
										<div x-show="isUploading" style="display: none;">
											<div class="progress">
												<div class="progress-bar bg-primary" aria-valuemin="0" aria-valuemax="100" style="transition: width 1s" :style="`width: ${progress}%;`"></div>
											</div>
										</div>
										@include('users.includes.architect.crop-image-modal')
									</div>
								</div>
							</div>
						</div>
					</div>
					@error('profile_pic_path')<div class="error">{{ $message }}</div>@enderror
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="row g-3">
				<div class="col-md-2">
					<label for="inputPreviewText" class="col-form-label text-dark fs-6 fw-medium">Abstract about you: </label>
					<label class="m-0 d-block form-text text-secondary fs-7" for="">Please share an abstract about you written in 3rd person or you can also upload the brief.</label>
				</div>
				<div class="col-md-10">
					<div class="row g-3">
						<div class="col-md-12">
							<textarea id="inputPreviewText" class="form-control @error('brief') is-invalid @enderror" wire:model="brief" rows="6" placeholder="Write an introduction about you..."></textarea>
							@error('brief')<div class="invalid-feedback">{{ $message }}</div>@enderror
						</div>
						<div class="col-md-12">
							<div class="mb-2 card">
								<div class="bg-white border card-body rounded-3 border-light">
									<div class="row align-items-center">
										<div class="col-12" x-data="fileUpload('projectBrief')">
											<div
												x-on:drop="isDropping = false"
												x-on:drop.prevent="handleFilesDrop($event)"
												x-on:dragover.prevent="isDropping = true"
												x-on:dragleave.prevent="isDropping = false"
											>
												<div class="top-0 bottom-0 z-30 flex opacity-75 position-absolute start-0 end-0 justify-content-center align-items-center bg-primary rounded-2" x-show="isDropping" style="display: none;">
													<span class="text-white fs-4">Release file to upload!</span>
												</div>
												<div class="d-flex justify-content-center align-items-center">
													<div class="text-gray-600 upload-icon rounded-circle fs-5">
														<i class="bi bi-cloud-upload"></i>
													</div>
												</div>
												<p class="py-2 m-0 text-center card-text text-secondary fs-6">
													<label for="imagesFiles"><span class="text-purple-700 cursor-pointer fw-semibold">Click to upload</span></label> or drag and drop
												</p>
												<input type="file" id="imagesFiles" class="d-none" @change="handleFilesSelect" multiple>
												@if(count($projectBrief) > 0 || count($oldProjectBrief) > 0)
													<ul class="flex-wrap mt-3 d-block" style="list-style: none;">
														@foreach ($projectBrief as $key => $imagesFile)
															@if(method_exists($imagesFile, 'temporaryUrl'))
																<li class="p-0 position-relative" wire:key="projectBrief{{ $key }}">
																	{{ $imagesFile->getClientOriginalName() }}
																	<button type="button" class="btn btn-link text-danger text-decoration-none" @click="removeUpload('{{ $imagesFile->getFilename() }}')">X</button>
																</li>
															@else

															@endif
														@endforeach
														@foreach ($oldProjectBrief as $key => $imagesFile)
															<li class="p-0 position-relative" wire:key="oldProjectBrief{{ $key }}">
																<a href="{{ Storage::url($imagesFile) }}" class="text-purple-700">See Brief File {{ $loop->iteration }}</a>
																<button type="button" class="btn btn-link text-danger text-decoration-none" wire:click="removeImage({{ $key }})">X</button>
															</li>
													@endforeach
													</ul>
												@endif
												<div x-show="isUploading" style="display: none;">
													<div class="progress">
														<div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="transition: width 1s" :style="`width: ${progress}%;`"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							@error('projectBrief')<div class="error">{{ $message }}</div>@enderror
							@error('projectBrief.*')<div class="error">{{ $message }}</div>@enderror
						</div>
					</div>
				</div>
			</div>
		</div>

		<hr class="border-gray-300">

		<div class="col-md-12 text-end">
			<button class="btn btn-white fs-6 fw-semibold" type="button" wire:click="draft">
				Save Draft <x-users.spinners.primary-btn wire:target="draft" />
			</button>
			<button class="btn btn-primary fs-6 fw-semibold ms-2" type="submit">
				Submit Interview <x-users.spinners.white-btn wire:target="submit" />
			</button>
		</div>
	</div>
	@include('users.includes.common.file-upload-script', ['width' => 400, 'height' => 400])
	@include('users.includes.common.modal-submit-interview')
</form>
