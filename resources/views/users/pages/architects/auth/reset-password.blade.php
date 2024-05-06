@extends('users.layouts.auth')

{!! seo() !!}

@section('body')
<div class="container">
	<div class="pt-5 bg-white row justify-content-center">
		<div class="col-lg-10">
			<div class="border shadow card rounded-4 border-1">
				<div class="row g-0 align-items-center">
					<div class="col-sm-12 col-md-6">
						<div class="row justify-content-between align-items-center">
							<div class="col-12">
								<div class="px-5 card-body">
									<h5 class="py-2 m-0 card-title text-dark fs-3 fw-semibold">Reset Password</h5>
									<livewire:architects.auth.reset-password :token="$token" :email="$email" />
									<p class="py-2 m-0 text-center card-text text-secondary fs-6">
										Already have an account?
										<a href="{{ route('architect.login') }}" class="text-purple-700 fw-semibold">Log in</a>
									</p>
								</div>
							</div>
						</div>
					</div>
					<x-users.auth.image-column :src="asset('images/login/fublis.png')" showImg="true" />
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
