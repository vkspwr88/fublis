<div>
	@include('livewire.journalists.signup-wizard.navigation')

	<div class="row bg-white justify-content-center pt-5">
		<div class="col-lg-10">
			<div class="card rounded-4 shadow border border-1">
				<div class="row g-0 align-items-start">
					<div class="col-sm-12 col-md-6">
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
										<span class="fw-medium">{{ $email }}</span>
									</p>
									<form class="py-3" action="" wire:submit="verify">
										@if ($errors->any())
											<div class="alert alert-danger">
												<ul>
													@foreach ($errors->all() as $error)
														@if($loop->first)
															<li>{{ $error }}</li>
														@endif
													@endforeach
												</ul>
											</div>
										@endif
										<div class="row mb-4">
											<input type="text" class="col m-1 form-control otp-inputs text-center text-purple-600 rounded-3 shadow border border-2 border-purple-600 fs-1 fw-medium" maxlength="1" wire:model="otp.1" />
											<input type="text" class="col m-1 form-control otp-inputs text-center text-purple-600 rounded-3 shadow border border-2 border-purple-600 fs-1 fw-medium" maxlength="1" wire:model="otp.2" />
											<input type="text" class="col m-1 form-control otp-inputs text-center text-purple-600 rounded-3 shadow border border-2 border-purple-600 fs-1 fw-medium" maxlength="1" wire:model="otp.3" />
											<input type="text" class="col m-1 form-control otp-inputs text-center text-purple-600 rounded-3 shadow border border-2 border-purple-600 fs-1 fw-medium" maxlength="1" wire:model="otp.4" />
										</div>
										<div class="d-grid">
											<button class="btn btn-primary fs-6 fw-semibold" type="submit">
												Verify email <x-users.spinners.white-btn wire:target="verify" />
											</button>
										</div>
									</form>
									<p class="card-text text-center text-secondary fs-6 m-0 py-2">
										Didn't receive the email?
										<a href="javascript:;" class="text-purple-700 fw-semibold" wire:click="resend">
											Click to resend <x-users.spinners.primary-btn wire:target="resend" />
										</a>
									</p>
									<p class="card-text text-center fs-6 fw-semibold m-0 py-2"><a href="javascript:;" class="text-secondary" wire:click="previousStep"><i class="bi bi-arrow-left"></i> Back to signup</a></p>
								</div>
							</div>
						</div>
					</div>
					<x-users.auth.image-column :src="asset('images/signup/fublis.png')" />
				</div>
			</div>
		</div>
	</div>
</div>

