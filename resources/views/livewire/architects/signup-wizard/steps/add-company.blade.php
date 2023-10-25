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
											<input type="text" class="form-control" id="inputCompanyName" placeholder="Name of your brand / studio" wire:model="companyName">
										</div>
										<div class="mb-3">
											<label for="inputWebsite" class="form-label text-dark fs-6 fw-medium">Website</label>
											<div class="input-group">
												<span class="input-group-text bg-white" id="basic-addon1">http://</span>
												<input type="text" class="form-control" id="inputWebsite" placeholder="www.your-website.com" aria-label="Username" aria-describedby="basic-addon1" wire:model="website">
											</div>
										</div>
										<div class="mb-3">
											<label for="selectLocation" class="form-label text-dark fs-6 fw-medium">Location</label>
											<select class="form-select" id="selectLocation" wire:model="location">
												<option selected>Choose...</option>
												<option value="1">One</option>
												<option value="2">Two</option>
												<option value="3">Three</option>
											</select>
										</div>
										<div class="mb-3">
											<label for="selectCategory" class="form-label text-dark fs-6 fw-medium">Category</label>
											<select class="form-select" id="selectCategory" wire:model="category">
												<option selected>Choose...</option>
												<option value="1">One</option>
												<option value="2">Two</option>
												<option value="3">Three</option>
											</select>
										</div>
										<div class="mb-3">
											<label for="selectTeamSize" class="form-label text-dark fs-6 fw-medium">Team Size</label>
											<select class="form-select" id="selectTeamSize" wire:model="teamSize">
												<option selected>Choose...</option>
												<option value="1">One</option>
												<option value="2">Two</option>
												<option value="3">Three</option>
											</select>
										</div>
										<div class="mb-3">
											<label for="selectPosition" class="form-label text-dark fs-6 fw-medium">Your Position in Company</label>
											<select class="form-select" id="selectPosition" wire:model="position">
												<option selected>Choose...</option>
												<option value="1">One</option>
												<option value="2">Two</option>
												<option value="3">Three</option>
											</select>
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

