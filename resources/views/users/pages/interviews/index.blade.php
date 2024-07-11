@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container py-5">
	<div class="mb-5 row">
		<div class="col-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="{{ route('home') }}" class="text-secondary fs-6 fw-medium"><i class="bi bi-house"></i></a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="javascript:;" class="text-secondary fs-6 fw-medium">Interview</a>
					</li>
					{{-- <li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="javascript:;" class="text-secondary fs-6 fw-medium">People</a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="javascript:;" class="text-secondary fs-6 fw-medium">{{ $architect->company->category->name }}</a>
					</li> --}}
					<li class="breadcrumb-item fublis-breadcrumb-item fs-6 fw-medium" aria-current="page">
						<span class="text-purple-600 bg-purple-100 badge">
							{{ Str::headline($interview->slug) }}
						</span>
					</li>
				</ol>
			</nav>
		</div>
		<div class="col-12">
			<h3 class="m-0">Interview</h3>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<h2 class="m-0 text-dark fs-3 fw-semibold">{{ $interview->heading }}</h2>
			<p class="m-0 text-secondary fs-5">{{ $interview->description }}</p>
		</div>
	</div>

	<hr class="my-4 border-gray-300">

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
				<div class="row g-4">
					@foreach ($interview->interviewQuestions as $question)
						<div class="col-md-12" wire:key="{{ $question->id }}">
							<div class="row g-3">
								<div class="col-md-12">
									<div class="row g-3">
										<div class="col-auto" style="width: 50px;">
											<img src="{{ asset('images/logo/quest_icon.png') }}" alt=".." class="img-square img-32" />
										</div>
										<div class="col text-purple-800 fw-semibold fs-6">
											{{ $question->question }}
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="row g-3">
										<div class="col-auto fw-semibold text-dark" style="width: 50px;">
											You:
										</div>
										<div class="col">
											<textarea class="form-control" rows="5" placeholder="Write your answer..."></textarea>
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
											{{-- @if($form->coverImage)
												<ul class="p-0 mt-3 text-center" style="list-style: none;">
													@if(method_exists($form->coverImage, 'temporaryUrl'))
														<li>
															<img class="img-fluid img-thumbnail" src="{{ $form->coverImage->temporaryUrl() }}" alt="">
														</li>
														<li class="mt-2">
															<button type="button" class="btn btn-primary fs-6 fw-medium" @click="removeUpload('{{ $form->coverImage->getFilename() }}')">Remove</button>
														</li>
													@else
														<li>
															<img class="img-fluid img-thumbnail" src="{{ Storage::url($form->coverImage) }}" alt="">
														</li>
													@endif
												</ul>
											@endif --}}
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
						@error('form.coverImage')<div class="error">{{ $message }}</div>@enderror
					</div>
				</div>
			</div>

			<div class="col-md-12">
				<div class="row g-3">
					<div class="col-md-2">
						<label for="inputPreviewText" class="col-form-label text-dark fs-6 fw-medium">Abstract about you: </label>
						<label class="m-0 d-block form-text text-secondary fs-7" for="">Please share an abstract about you written in 3rd person. You can also upload the brief.</label>
					</div>
					<div class="col-md-10">
						<textarea id="inputPreviewText" class="form-control @error('form.previewText') is-invalid @enderror" wire:model="form.previewText" wire:keydown.debounce.1000ms="characterCount" rows="6" placeholder="Write an introduction about you..."></textarea>
						@error('form.previewText')<div class="invalid-feedback">{{ $message }}</div>@enderror
					</div>
					<div class="col-md-12">
						<div class="mb-2 card">
							<div class="bg-white border card-body rounded-3 border-light">
								<div class="row align-items-center">
									<div class="col-12" x-data="fileUpload('form.imagesFiles')">
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
											{{-- @if(count($form->imagesFiles) > 0 || count($form->oldImagesFiles) > 0)
												<ul class="flex-wrap mt-3 d-flex" style="list-style: none;">
													@foreach ($form->oldImagesFiles as $imagesFile)
														<li class="p-2 position-relative">
															<img class="img-fluid img-thumbnail" width="150" src="{{ Storage::url($imagesFile->image_path) }}" alt="">
															<button type="button" class="top-0 btn btn-sm btn-secondary rounded-circle text-decoration-none position-absolute end-0" wire:click="removeImage('{{ $imagesFile->id }}')">X</button>
														</li>
													@endforeach
													@foreach ($form->imagesFiles as $key => $imagesFile)
														@if(method_exists($imagesFile, 'temporaryUrl'))
															<li class="p-2 position-relative" wire:key="{{ $key }}">
																<img class="img-fluid img-thumbnail" width="150" src="{{ $imagesFile->temporaryUrl() }}" alt="">
																<button type="button" class="top-0 btn btn-sm btn-secondary rounded-circle text-decoration-none position-absolute end-0" @click="removeUpload('{{ $imagesFile->getFilename() }}')">X</button>
															</li>
														@else
															<li class="p-2 position-relative" wire:key="{{ $key }}">
																<img class="img-fluid img-thumbnail" width="150" src="{{ Storage::url($imagesFile) }}" alt="">
																<button type="button" class="top-0 btn btn-sm btn-secondary rounded-circle text-decoration-none position-absolute end-0" wire:click="removeImage({{ $key }})">X</button>
															</li>
														@endif
													@endforeach
												</ul>
											@endif --}}
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
						@error('form.imagesFiles')<div class="error">{{ $message }}</div>@enderror
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
	</form>

</div>
@endsection
