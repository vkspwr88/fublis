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
									<div class="row justify-content-center align-items-center">
										<div class="col-auto">
											<div class="mail-icon rounded-circle text-purple-600 fs-5">
												<i class="bi bi-envelope"></i>
											</div>
										</div>
									</div>
									<h5 class="card-title text-center text-dark fs-3 fw-semibold m-0 py-2">Check your email</h5>
									<p class="card-text text-center text-secondary fs-6 fw-normal m-0 py-2">
										We sent a verification link to
										<br>
										<span class="fw-medium">olivia@untitledui.com</span>
									</p>
									<form class="py-3" action="" wire:submit="verify">
										<div class="row mb-4">
											<div class="col">
												<input type="text" class="form-control text-center text-purple-600 rounded-3 shadow border border-2 border-purple-600 fs-1 fw-medium" id="exampleInputLetter1">
											</div>
											<div class="col">
												<input type="text" class="form-control text-center text-purple-600 rounded-3 shadow border border-2 border-purple-600 fs-1 fw-medium" id="exampleInputLetter1">
											</div>
											<div class="col">
												<input type="text" class="form-control text-center text-purple-600 rounded-3 shadow border border-2 border-purple-600 fs-1 fw-medium" id="exampleInputLetter1">
											</div>
											<div class="col">
												<input type="text" class="form-control text-center text-purple-600 rounded-3 shadow border border-2 border-purple-600 fs-1 fw-medium" id="exampleInputLetter1">
											</div>
										</div>
										<div class="d-grid">
											<button class="btn btn-primary fs-6 fw-semibold" type="submit">Verify email</button>
										</div>
									</form>
									<p class="card-text text-center text-secondary fs-6 m-0 py-2">Didn't receive the email? <a href="{{ route('architect.login') }}" class="text-purple-700 fw-semibold">Click to resend</a></p>
									<p class="card-text text-center fs-6 fw-semibold m-0 py-2"><a href="{{ route('architect.login') }}" class="text-secondary"><i class="bi bi-arrow-left"></i> Back to signup</a></p>
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

