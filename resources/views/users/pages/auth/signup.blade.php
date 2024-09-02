@extends('users.layouts.auth')

{!! seo() !!}

@push('styles')
	<style>
		@media(max-width: 768px){
			#brandSignUpColumn{
				border-right: none !important;
				border-bottom: 1px solid var(--bs-border-color) !important;
			}
			/* #brandSignUpColumn .card-body{
			} */
		}
	</style>
@endpush

@section('body')
<div class="container">
	<h4 class="py-2 m-0 text-center text-black fs-3 fw-bold">Choose your account type</h4>
	<p class="py-2 m-0 text-center text-black fs-6 fw-normal">You're just 2 mins away from experiencing new world of publishing.</p>
	<div class="pt-4 row g-4 gy-5">
		<div class="col-xl-10 offset-xl-1">
			<div class="border shadow card rounded-4 border-1">
				<div class="row g-0 align-items-center">
					<div class="col-md-6 border-end" id="brandSignUpColumn">
						<div class="px-4 py-5 card-body px-lg-5 px-md-4 px-sm-5">
							<h5 class="pb-2 m-0 card-title text-dark fs-3 fw-semibold">Sign up as a Brand</h5>
							<p class="py-2 m-0 card-text text-secondary fs-6 fw-normal">For Architecture & Design Firms, Brands, Businesses & Startups</p>
							<div class="gap-3 d-grid">
								<a href="{{ route('architect.signup') }}" class="btn btn-primary fs-6 fw-semibold" type="button">Sign up as Brand</a>
								<a href="{{ route('auth.google.index', ['userType' => 'architect', 'loginType' => 'signup']) }}" class="btn btn-white fs-6 fw-semibold" type="button">
									<svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
										<g clip-path="url(#clip0_950_3927)">
											<path d="M24.5163 12.2763C24.5163 11.4605 24.4501 10.6404 24.309 9.83789H12.9902V14.4589H19.472C19.203 15.9492 18.3388 17.2676 17.0733 18.1054V21.1037H20.9403C23.2111 19.0137 24.5163 15.9272 24.5163 12.2763Z" fill="#4285F4"/>
											<path d="M12.9901 24.0013C16.2266 24.0013 18.9559 22.9387 20.9445 21.1044L17.0776 18.106C16.0017 18.838 14.6127 19.2525 12.9945 19.2525C9.86388 19.2525 7.20946 17.1404 6.25705 14.3008H2.2666V17.3917C4.30371 21.4439 8.4529 24.0013 12.9901 24.0013Z" fill="#34A853"/>
											<path d="M6.25277 14.3007C5.75011 12.8103 5.75011 11.1965 6.25277 9.70618V6.61523H2.26674C0.564734 10.006 0.564734 14.0009 2.26674 17.3916L6.25277 14.3007Z" fill="#FBBC04"/>
											<path d="M12.9901 4.74966C14.7009 4.7232 16.3544 5.36697 17.5934 6.54867L21.0195 3.12262C18.8501 1.0855 15.9708 -0.034466 12.9901 0.000808666C8.4529 0.000808666 4.30371 2.55822 2.2666 6.61481L6.25264 9.70575C7.20064 6.86173 9.85947 4.74966 12.9901 4.74966Z" fill="#EA4335"/>
										</g>
										<defs>
											<clipPath id="clip0_950_3927">
												<rect width="24" height="24" fill="white" transform="translate(0.75)"/>
											</clipPath>
										</defs>
									</svg> Sign up with Google
								</a>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="p-4 py-5 card-body px-lg-5 px-md-4 px-sm-5">
							<h5 class="pb-2 m-0 card-title text-dark fs-3 fw-semibold">Sign up as a Journalist</h5>
							<p class="py-2 m-0 card-text text-secondary fs-6 fw-normal">For journalists, editors, writers, or any other role working with a publication</p>
							<div class="gap-3 d-grid">
								<a href="{{ route('journalist.signup') }}" class="btn btn-primary fs-6 fw-semibold" type="button">Sign up as Journalist</a>
								<a href="{{ route('auth.google.index', ['userType' => 'journalist', 'loginType' => 'signup']) }}" class="btn btn-white fs-6 fw-semibold" type="button">
									<svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
										<g clip-path="url(#clip0_950_3927)">
											<path d="M24.5163 12.2763C24.5163 11.4605 24.4501 10.6404 24.309 9.83789H12.9902V14.4589H19.472C19.203 15.9492 18.3388 17.2676 17.0733 18.1054V21.1037H20.9403C23.2111 19.0137 24.5163 15.9272 24.5163 12.2763Z" fill="#4285F4"/>
											<path d="M12.9901 24.0013C16.2266 24.0013 18.9559 22.9387 20.9445 21.1044L17.0776 18.106C16.0017 18.838 14.6127 19.2525 12.9945 19.2525C9.86388 19.2525 7.20946 17.1404 6.25705 14.3008H2.2666V17.3917C4.30371 21.4439 8.4529 24.0013 12.9901 24.0013Z" fill="#34A853"/>
											<path d="M6.25277 14.3007C5.75011 12.8103 5.75011 11.1965 6.25277 9.70618V6.61523H2.26674C0.564734 10.006 0.564734 14.0009 2.26674 17.3916L6.25277 14.3007Z" fill="#FBBC04"/>
											<path d="M12.9901 4.74966C14.7009 4.7232 16.3544 5.36697 17.5934 6.54867L21.0195 3.12262C18.8501 1.0855 15.9708 -0.034466 12.9901 0.000808666C8.4529 0.000808666 4.30371 2.55822 2.2666 6.61481L6.25264 9.70575C7.20064 6.86173 9.85947 4.74966 12.9901 4.74966Z" fill="#EA4335"/>
										</g>
										<defs>
											<clipPath id="clip0_950_3927">
												<rect width="24" height="24" fill="white" transform="translate(0.75)"/>
											</clipPath>
										</defs>
									</svg> Sign up with Google
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12">
			<img src="{{ asset('images/home/fublis-banner.png') }}" alt="" class="img-fluid">
		</div>
	</div>
	{{-- <h4 class="py-2 m-0 text-center text-black fs-5 fw-bold">Get your stories published. It's fast & easy.</h4>
	<p class="py-2 m-0 text-center text-black fs-6 fw-normal">You’re just 2 mins away from pitching stories to journalists.</p>

	<livewire:architect-signup-wizard show-step="{{ $step }}" :initial-state="$initialState" /> --}}
</div>
@endsection
