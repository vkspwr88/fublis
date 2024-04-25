@extends('users.layouts.auth')

{!! seo() !!}

@section('body')
<div class="container">
	<div class="pt-5 bg-white row justify-content-center">
		<div class="col-lg-10">
			<div class="border shadow card rounded-4 border-1">
				<div class="row g-0 align-items-center">
					<div class="order-2 col-sm-12 col-md-6 order-md-1">
						<div class="row justify-content-between align-items-center">
							<div class="col-12">
								<div class="px-5 card-body">
									<h5 class="py-2 m-0 card-title text-dark fs-3 fw-semibold">Log in</h5>
									<p class="py-2 m-0 card-text text-secondary fs-6 fw-normal">Welcome back to Fublis! Turning your words, projects, PR into published stories in local & worldwide platforms</p>
									<livewire:architects.auth.login />
									<p class="py-2 m-0 text-center card-text text-secondary fs-6">
										Don't have an account?
										<a href="{{ route('architect.signup') }}" class="text-purple-700 fw-semibold">Sign Up</a>
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
