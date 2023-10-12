@extends('users.layouts.auth')

{!! seo() !!}

@section('body')
<div class="container">
	<h4 class="text-center text-black fs-5 fw-bold m-0 py-2">Get your stories published. It's fast & easy.</h4>
	<p class="text-center text-black fs-6 fw-normal m-0 py-2">You’re just 2 mins away from pitching stories to journalists.</p>
	<div class="row align-items-center pt-4">
		<div class="col-12">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="row">
						<div class="col-6">
							<div class="step-line bg-gray-200 w-100 position-relative"></div>
						</div>
						<div class="col-6">
							<div class="step-line bg-gray-200 w-100 position-relative"></div>
						</div>
					</div>
				</div>
			</div>

			<div class="row align-items-center">
				<div class="col-md-4 steps step-complete">
					<div class="d-flex justify-content-center align-items-center">
						<div class="step-icon rounded-circle">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M17.0965 7.38967L9.9365 14.2997L8.0365 12.2697C7.6865 11.9397 7.1365 11.9197 6.7365 12.1997C6.3465 12.4897 6.2365 12.9997 6.4765 13.4097L8.7265 17.0697C8.9465 17.4097 9.3265 17.6197 9.7565 17.6197C10.1665 17.6197 10.5565 17.4097 10.7765 17.0697C11.1365 16.5997 18.0065 8.40967 18.0065 8.40967C18.9065 7.48967 17.8165 6.67967 17.0965 7.37967V7.38967Z" fill="white"/>
							</svg>
							{{-- <div class="inner-circle rounded-circle"></div> --}}
						</div>
					</div>
					<div class="row align-items-center pt-2">
						<div class="col-12">
							<p class="step-title text-center fs-6 fw-semibold m-0 p-0">Your details</p>
							<p class="step-subtitle text-center fs-6 fw-normal m-0 p-0">Please provide your name and email</p>
						</div>
					</div>
				</div>

				<div class="col-md-4 steps step-current">
					<div class="d-flex justify-content-center align-items-center">
						<div class="step-icon rounded-circle">
							<div class="inner-circle rounded-circle"></div>
						</div>
					</div>
					<div class="row align-items-center pt-2">
						<div class="col-12">
							<p class="step-title text-center fs-6 fw-semibold m-0 p-0">Verify your account</p>
							<p class="step-subtitle text-center fs-6 fw-normal m-0 p-0">Confirm your email</p>
						</div>
					</div>
				</div>

				<div class="col-md-4 steps step-incomplete">
					<div class="d-flex justify-content-center align-items-center">
						<div class="step-icon rounded-circle">
							<div class="inner-circle rounded-circle"></div>
						</div>
					</div>
					<div class="row align-items-center pt-2">
						<div class="col-12">
							<p class="step-title text-center fs-6 fw-semibold m-0 p-0">Add your company</p>
							<p class="step-subtitle text-center fs-6 fw-normal m-0 p-0">Add your company name & location</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row bg-white justify-content-center pt-5">
		<div class="col-md-10">
			<div class="card rounded-4 shadow border border-1">
				<div class="row g-0 align-items-center">
					<div class="col-md-6">
						<div class="row justify-content-between align-items-center">
							<div class="col-12">
								<div class="card-body px-5">
									<h5 class="card-title text-dark fs-3 fw-semibold m-0 py-2">Sign up</h5>
									<p class="card-text text-secondary fs-6 fw-normal m-0 py-2">Create your free account</p>
									<form class="py-3" action="">
										<div class="mb-3">
											<label for="exampleInputName" class="form-label text-dark fs-6 fw-medium">Name<span class="text-danger">*</span></label>
											<input type="text" class="form-control" id="exampleInputName" placeholder="Enter your name">
										</div>
										<div class="mb-3">
											<label for="exampleInputEmail" class="form-label text-dark fs-6 fw-medium">Email<span class="text-danger">*</span></label>
											<input type="email" class="form-control" id="exampleInputEmail" placeholder="Enter your email">
										</div>
										<div class="mb-3">
											<label for="exampleInputPassword" class="form-label">Password<span class="text-danger">*</span></label>
											<input type="password" class="form-control" id="exampleInputPassword" placeholder="Create a password" aria-describedby="passwordHelpBlock">
											<div id="passwordHelpBlock" class="form-text">Must be at least 8 characters.</div>
										</div>
										<div class="d-grid gap-3">
											<button class="btn btn-primary fs-6 fw-semibold" type="button">Get started</button>
											<button class="btn btn-white fs-6 fw-semibold" type="button">
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
											</button>
										</div>
									</form>
									<p class="card-text text-center text-secondary fs-6 m-0 py-2">Already have an account? <a href="{{ route('architect.login') }}" class="text-purple-700 fw-semibold">Log in</a></p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<img src="https://via.placeholder.com/504x704" class="img-fluid rounded-4 w-100" alt="...">
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row bg-white justify-content-center pt-5">
		<div class="col-md-10">
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
									<form class="py-3" action="">
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
											<button class="btn btn-primary fs-6 fw-semibold" type="button">Verify email</button>
										</div>
									</form>
									<p class="card-text text-center text-secondary fs-6 m-0 py-2">Didn't receive the email? <a href="{{ route('architect.login') }}" class="text-purple-700 fw-semibold">Click to resend</a></p>
									<p class="card-text text-center fs-6 fw-semibold m-0 py-2"><a href="{{ route('architect.login') }}" class="text-secondary"><i class="bi bi-arrow-left"></i> Back to signup</a></p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<img src="https://via.placeholder.com/504x704" class="img-fluid rounded-4 w-100" alt="...">
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row bg-white justify-content-center pt-5">
		<div class="col-md-10">
			<div class="card rounded-4 shadow border border-1">
				<div class="row g-0 align-items-center">
					<div class="col-md-6">
						<div class="row justify-content-between align-items-center">
							<div class="col-12">
								<div class="card-body px-5">
									<form class="py-3" action="">
										<div class="mb-3">
											<label for="exampleInputName" class="form-label text-dark fs-6 fw-medium">Company Name</label>
											<input type="text" class="form-control" id="exampleInputName" placeholder="Name of your brand/ studio">
										</div>
										<div class="mb-3">
											<label for="exampleInputName" class="form-label text-dark fs-6 fw-medium">Website</label>
											<div class="input-group">
												<span class="input-group-text bg-white" id="basic-addon1">http://</span>
												<input type="text" class="form-control" placeholder="www.your-website.com" aria-label="Username" aria-describedby="basic-addon1">
											</div>
										</div>
										<div class="mb-3">
											<label for="exampleInputName" class="form-label text-dark fs-6 fw-medium">Location</label>
											<select class="form-select" id="inputGroupSelect02">
												<option selected>Choose...</option>
												<option value="1">One</option>
												<option value="2">Two</option>
												<option value="3">Three</option>
											</select>
										</div>
										<div class="mb-3">
											<label for="exampleInputName" class="form-label text-dark fs-6 fw-medium">Category</label>
											<select class="form-select" id="inputGroupSelect02">
												<option selected>Choose...</option>
												<option value="1">One</option>
												<option value="2">Two</option>
												<option value="3">Three</option>
											</select>
										</div>
										<div class="mb-3">
											<label for="exampleInputName" class="form-label text-dark fs-6 fw-medium">Team Size</label>
											<select class="form-select" id="inputGroupSelect02">
												<option selected>Choose...</option>
												<option value="1">One</option>
												<option value="2">Two</option>
												<option value="3">Three</option>
											</select>
										</div>
										<div class="mb-3">
											<label for="exampleInputName" class="form-label text-dark fs-6 fw-medium">Your Position in Company</label>
											<select class="form-select" id="inputGroupSelect02">
												<option selected>Choose...</option>
												<option value="1">One</option>
												<option value="2">Two</option>
												<option value="3">Three</option>
											</select>
										</div>
										<div class="d-grid">
											<button class="btn btn-primary fs-6 fw-semibold" type="button">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<img src="https://via.placeholder.com/504x704" class="img-fluid rounded-4 w-100" alt="...">
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row bg-white justify-content-center pt-5">
		<div class="col-md-10">
			<div class="card rounded-4 shadow border border-1">
				<div class="row justify-content-between align-items-center">
					<div class="col-12">
						<div class="row justify-content-center">
							<div class="col-md-10">
								<div class="card-body p-5 text-center">
									<h5 class="card-title text-purple-900 fs-3 fw-semibold m-0 py-3">Great!<br>You’re all set to go.</h5>
									<p class="card-text text-secondary fs-6 fw-normal m-0 py-3">Getting published was never this easy. Pitch your latest projects, press releases, brand stories to journalists. Start creating your media kits now.</p>
									<p class="card-text m-0 py-3">
										<button class="btn btn-primary fs-6 fw-semibold" type="button">Let Go!</button>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
