@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container py-5">
	@include('users.includes.architect.add-story-steps')

	<div class="row justify-content-center pt-5">
		<div class="col-md-10">
			<div class="card rounded-4 shadow border border-1">
				<div class="row justify-content-between align-items-center">
					<div class="col-12">
						<div class="row justify-content-center">
							<div class="col-md-10">
								<div class="card-body p-5 text-center">
									<h5 class="card-title text-purple-900 fs-1 fw-semibold m-0 py-3">Your story is live.<br>Pitch Now!</h5>
									<p class="card-text text-secondary fs-6 fw-normal m-0 py-3">Start exploring the publishing platforms readily available on Fublis. You can also respond to invited call for submissions that match your uploaded story.</p>
									<p class="card-text m-0 py-3">
										<a class="btn btn-primary btn-lg fs-6 fw-semibold" href="{{ route('architect.pitch-story.index') }}">Pitch Story</a>
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
