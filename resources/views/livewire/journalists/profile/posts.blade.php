<div class="row g-3">
	@if($journalist->user_id === auth()->id())
	<div class="col-12">
		<div class="card rounded-4 shadow border-0 bg-light">
			<div class="card-body">
				<form wire:submit="save">
					<div class="row g-4">
						@if ($errors->any())
						<div class="col-12">
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						</div>
						@endif
						<div class="col-12">
							<div class="row align-items-center g-2">
								<div class="col-md-auto">
									<div class="row align-items-center g-2">
										<div class="col-auto">
											<img src="{{ $journalist->profileImage ? Storage::url($journalist->profileImage->image_path) : 'https://via.placeholder.com/40x40' }}" class="img-square img-40" alt="logo">
										</div>
										<div class="col-auto">
											<input type="radio" id="story-project" value="Project" wire:model="selectedStoryType" class="position-absolute opacity-0 list-radio">
											<div class="px-3 py-2 d-inline-block border rounded-2 bg-white">
												<label for="story-project" class="fw-semibold">Project +</label>
											</div>
										</div>
										<div class="col-auto">
											<input type="radio" id="story-article" value="Article" wire:model="selectedStoryType" class="position-absolute opacity-0 list-radio">
											<div class="px-3 py-2 d-inline-block border rounded-2 bg-white">
												<label for="story-article" class="fw-semibold">Article +</label>
											</div>
										</div>
										<div class="col-auto">
											<input type="radio" id="story-press" value="Press Release" wire:model="selectedStoryType" class="position-absolute opacity-0 list-radio">
											<div class="px-3 py-2 d-inline-block border rounded-2 bg-white">
												<label for="story-press" class="fw-semibold">Press Release +</label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md">
									<div class="row justify-content-end align-items-center">
										<div class="col-auto">
											<select wire:model="selectedCategory" class="form-select @error('selectedCategory') is-invalid @enderror">
												<option value="">Select Category</option>
												@foreach ($categories as $category)
													<option value="{{ $category->id }}">{{ $category->name }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12">
							<textarea class="form-control text-dark rounded-3 border-0 @error('postUrl') is-invalid @enderror" rows="2" placeholder="Insert URL here" style="background: #CACACA" wire:model="postUrl" wire:blur="loadMeta"></textarea>
							<div class="mt-2">
								<x-users.spinners.primary-btn wire:target="loadMeta" style="height: 30px; width: 30px;" />
							</div>
						</div>
						@if($showMeta)
						<div class="col-12 text-dark">
							<h4 class="fs-5 fw-semibold">{{ $metaTitle }}</h4>
							<p class="fs-6">{{ $metaContent }}</p>
						</div>
						@endif
						<div class="col-12">
							<div class="row align-items-center">
								<div class="col-auto">
									<select class="form-select @error('selectedPublication') is-invalid @enderror" wire:model="selectedPublication">
										<option value="">Select Publication</option>
										@foreach ($publications as $publication)
											<option value="{{ $publication->id }}">{{ $publication->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="col">
									<div class="row justify-content-end align-items-center">
										<div class="col-auto">
											<button type="submit" class="btn btn-primary">
												Post <i class="bi bi-send-fill" wire:loading.remove></i>
												<x-users.spinners.white-btn wire:target="save" />
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	@endif
	<x-users.profile.journalist-post :posts="$posts" />
</div>
