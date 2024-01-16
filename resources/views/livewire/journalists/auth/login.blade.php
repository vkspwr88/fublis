<form class="py-3" wire:submit="login">
	<div class="mb-3">
		<label for="inputEmail" class="form-label text-dark fs-6 fw-medium">Email<span class="text-danger">*</span></label>
		<input type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" placeholder="Enter your email" wire:model="email">
		@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="mb-3">
		<label for="inputPassword" class="form-label">Password<span class="text-danger">*</span></label>
		<div class="input-group">
			<input type="password" class="form-control border-end-0 @error('password') is-invalid @enderror" id="inputPassword" placeholder="Enter your password" wire:model="password">
			<button id="inputPasswordToggle" class="btn btn-outline-white border border-start-0 @error('password') border-danger @enderror" type="button" onclick="togglePassword('#inputPassword')">
				<i class="bi bi-eye"></i>
			</button>
		</div>
		@error('password')<div class="error">{{ $message }}</div>@enderror
		{{-- <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword" placeholder="Create a password" aria-describedby="passwordHelpBlock" wire:model="password">
		@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror --}}
	</div>
	<div class="d-grid gap-3">
		<button class="btn btn-primary fs-6 fw-semibold" type="submit">
			Log In <x-users.spinners.white-btn wire:target="login" />
		</button>
		<a href="{{ route('auth.google.index', ['userType' => 'journalist']) }}" class="btn btn-white fs-6 fw-semibold" type="button">
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
			</svg> Log in with Google
		</a>
	</div>
</form>
