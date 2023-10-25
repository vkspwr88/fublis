<div>
	@include('livewire.architects.signup-wizard.navigation')

	<div class="row bg-white justify-content-center pt-5">
		<div class="col-lg-10">
			<div class="card rounded-4 shadow border border-1">
				<div class="row g-0 align-items-center">
					<div class="col-md-6">
						<div class="row justify-content-between align-items-center">
							<div class="col-12">
								<div class="card-body px-5">
									<form class="py-3" wire:submit="add">
										<div class="mb-3">
											<label for="inputCompanyName" class="form-label text-dark fs-6 fw-medium">Company Name</label>
											<input type="text" class="form-control  @error('companyName') is-invalid @enderror" id="inputCompanyName" placeholder="Name of your brand / studio" wire:model.live="companyName">
											@error('companyName')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
											<label for="selectCategory" class="form-label text-dark fs-6 fw-medium">Category</label>
											<select class="form-select @error('category') is-invalid @enderror" id="selectCategory" wire:model="category">
												<option value="">Select Category</option>
												@foreach ($categories as $category)
													<option value="{{ $category->id }}">{{ $category->name }}</option>
												@endforeach
											</select>
											@error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
										</div>
										<div class="mb-3">
											<label for="selectTeamSize" class="form-label text-dark fs-6 fw-medium">Team Size</label>
											<select class="form-select @error('teamSize') is-invalid @enderror" id="selectTeamSize" wire:model="teamSize">
												<option value="">Select Team Size</option>
												@foreach ($teamSizes as $teamSize)
												<option value="{{ $teamSize->id }}">{{ $teamSize->name }}</option>
												@endforeach
											</select>
											@error('teamSize')<div class="invalid-feedback">{{ $message }}</div>@enderror
										</div>
										<div class="mb-3">
											<label for="selectPosition" class="form-label text-dark fs-6 fw-medium">Your Position in Company</label>
											<select class="form-select @error('position') is-invalid @enderror" id="selectPosition" wire:model="position">
												<option value="">Select Your Position</option>
												@foreach ($positions as $position)
												<option value="{{ $position->id }}">{{ $position->name }}</option>
												@endforeach
											</select>
											@error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
										</div>
										<div class="d-grid">
											<button class="btn btn-primary fs-6 fw-semibold" type="submit">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-0 col-md-6 d-none d-md-flex">
						<img src="https://via.placeholder.com/504x704" class="img-fluid rounded-4 w-100" alt="...">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

