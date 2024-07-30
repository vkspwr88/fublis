@extends('users.layouts.affiliates.register')

@section('body')
	<h4 class="py-2 m-0 text-center text-black fs-5 fw-bold">Join Fublis as an affiliate and start earning with us.</h4>
	<p class="py-2 m-0 text-center text-black fs-6 fw-normal">You're just 2 mins away from becoming an affiliate with us.</p>

	<div class="pt-5 bg-white row justify-content-center">
		<div class="col-lg-10">
			<div class="border shadow card rounded-4 border-1">
				<div class="row g-0 align-items-center">
					<div class="col-sm-12 col-md-6">
						<div class="row justify-content-between align-items-center">
							<div class="col-12">
								<div class="px-5 card-body">
									<h5 class="py-2 m-0 card-title text-dark fs-3 fw-semibold">Affiliate Registration</h5>
									<p class="py-2 m-0 card-text text-secondary fs-6 fw-normal">You must be registered as a journalist with Fublis and add publication (website/ social media page) before applying for Affiliate Program.</p>
									<p class="py-3 m-0 card-text text-secondary fs-6 fw-normal">New on Fublis? <a href="{{ route('journalist.signup') }}" class="text-purple-700 fw-semibold">Sign Up</a> / Already Member? <a href="{{ route('journalist.login') }}" class="text-purple-700 fw-semibold">Log in</a></p>
									<livewire:affiliates.registration />
								</div>
							</div>
						</div>
					</div>
					<x-users.auth.image-column :src="asset('images/signup/fublis-affiliate.png')" />
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	<script>
		window.addEventListener('show-registration-success-modal', event => {
			$('#successRegistrationModal').modal('show');
		});
	</script>
@endpush
