<div class="row">
	<div class="col-md-4">
		<label for="coverImage" class="col-form-label text-dark fs-6 fw-medium">Cover Image <span class="text-danger">*</span></label>
		<label for="coverImage" class="m-0 d-block form-text text-secondary fs-7">This will be displayed on your media kit.<br>Kindly add a relevant cover image. For example, image of project/ product/ team/ brand logo/ founder/ event etc.</label>
	</div>
	<div class="col-md-8">
		<div class="card">
			<div class="bg-white border card-body rounded-3 border-light">
				<div class="row align-items-center g-4">
					<div class="col-12" x-data="fileUpload('form.coverImage')">
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
							<p class="py-2 m-0 text-center card-text text-secondary fs-6">{{ __('text.coverImage') }}</p>
							@if($form->coverImage)
								<ul class="p-0 mt-3 text-center" style="list-style: none;">
									@if(method_exists($form->coverImage, 'temporaryUrl'))
										<li>
											<img class="img-fluid img-thumbnail" src="{{ $form->coverImage->temporaryUrl() }}" alt="">
											{{-- {{ $coverImage->getClientOriginalName() }} --}}
										</li>
										<li class="mt-2">
											<button type="button" class="btn btn-primary fs-6 fw-medium" @click="removeUpload('{{ $form->coverImage->getFilename() }}')">Remove</button>
										</li>
									@else
										<li>
											<img class="img-fluid img-thumbnail" src="{{ Storage::url($form->coverImage) }}" alt="">
											{{-- {{ $coverImage->getClientOriginalName() }} --}}
										</li>
									@endif
								</ul>
							@endif
							<div x-show="isUploading" style="display: none;">
								<div class="progress">
									<div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="transition: width 1s" :style="`width: ${progress}%;`"></div>
								</div>
							</div>
							@include('users.includes.architect.crop-image-modal')
						</div>
					</div>
				</div>
			</div>
		</div>
		@error('form.coverImage')<div class="error">{{ $message }}</div>@enderror
	</div>
</div>
