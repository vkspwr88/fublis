<div class="col">
	<div class="card">
		<div class="card-body bg-white rounded-3 border border-light">
			<div class="row align-items-center">
				<div class="col-12" x-data="fileUpload('profileImage')">
					<div
						x-on:drop="isDropping = false"
						x-on:drop.prevent="handleCropFileDrop($event)"
						x-on:dragover.prevent="isDropping = true"
						x-on:dragleave.prevent="isDropping = false"
					>
						<div class="position-absolute top-0 bottom-0 start-0 end-0 z-30 flex justify-content-center align-items-center bg-primary opacity-75 rounded-2" x-show="isDropping" style="display: none;">
							<span class="fs-4 text-white">Release file to upload!</span>
						</div>
						<div class="d-flex justify-content-center align-items-center">
							<div class="upload-icon rounded-circle text-gray-600 fs-5">
								<i class="bi bi-cloud-upload"></i>
							</div>
						</div>
						<p class="card-text text-center text-secondary fs-6 m-0 py-2">
							<label for="inputProfileImage"><span class="text-purple-700 fw-semibold">Click to upload</span></label> or drag and drop
						</p>
						<input type="file" id="inputProfileImage" class="d-none" @change="handleCropFileSelect">
						<p class="card-text text-center text-secondary fs-6 m-0 py-2">{{ __('text.profileImage') }}</p>
						@if($profileImage)
							<ul class="mt-3 list-disc">
								<li>
									{{ $profileImage->getClientOriginalName() }}
									<button type="button" class="btn btn-link text-danger text-decoration-none" @click="removeUpload('{{ $profileImage->getFilename() }}')">X</button>
								</li>
							</ul>
						@endif
						<div x-show="isUploading" style="display: none;">
							<div class="progress">
								<div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" :style="`width: ${progress}%;`"></div>
							</div>
						</div>
						@include('users.includes.architect.crop-image-modal')
					</div>
				</div>
			</div>
		</div>
	</div>
	@error('profileImage')<div class="error">{{ $message }}</div>@enderror
</div>