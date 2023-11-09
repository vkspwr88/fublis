@extends('users.layouts.auth')

{!! seo() !!}

@section('body')
<div class="container">
	<div class="row bg-white justify-content-center pt-5">
		<div class="col-lg-10">
			<div class="card rounded-4 shadow border border-1">
				<div class="row g-0 align-items-center">
					<div class="col-sm-12 col-md-6">
						<div class="row justify-content-between align-items-center">
							<div class="col-12">
								<div class="card-body px-5">
									<h5 class="card-title text-dark fs-3 fw-semibold m-0 py-2">Architect Log in</h5>
									{{-- <p class="card-text text-secondary fs-6 fw-normal m-0 py-2">Create your free account</p> --}}
									<livewire:architects.auth.login />
									<p class="card-text text-center text-secondary fs-6 m-0 py-2">Don't have an account? <a href="{{ route('architect.signup') }}" class="text-purple-700 fw-semibold">Sign Up</a></p>
								</div>
							</div>
						</div>
					</div>
					<x-users.auth.image-column />
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
