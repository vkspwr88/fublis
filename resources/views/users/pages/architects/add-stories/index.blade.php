@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container py-5">
	@include('users.includes.architect.add-story-steps')
	<div class="row justify-content-center pt-5">
		<div class="col-lg-11">
			<div class="row g-4">
				<div class="col-lg-4">
					<div class="card add-story-card rounded-4 shadow border border-1 h-100">
						<div class="card-header rounded-top-4 border-0 py-5">
							<div class="justify-content-center align-items-center d-flex">
								<div class="text-center fs-1 rounded-circle bg-white"><i class="bi bi-plus"></i></div>
							</div>
						</div>
						<div class="card-body">
							<h5 class="card-title text-purple-700 fs-5 fw-semibold m-0 py-2">Create Press Release</h5>
							<div class="pt-3">
								<div class="row gx-2 pb-3">
									<div class="col-auto">
										<p class="card-text text-purple-600 fs-6 fw-normal mx-auto my-1"><i class="bi bi-check-circle"></i></p>
									</div>
									<div class="col">
										<p class="card-text text-secondary fs-6 fw-normal m-0">Announce a new hire</p>
									</div>
								</div>
								<div class="row gx-2 pb-3">
									<div class="col-auto">
										<p class="card-text text-purple-600 fs-6 fw-normal mx-auto my-1"><i class="bi bi-check-circle"></i></p>
									</div>
									<div class="col">
										<p class="card-text text-secondary fs-6 fw-normal m-0">Announce a store launch</p>
									</div>
								</div>
								<div class="row gx-2 pb-3">
									<div class="col-auto">
										<p class="card-text text-purple-600 fs-6 fw-normal mx-auto my-1"><i class="bi bi-check-circle"></i></p>
									</div>
									<div class="col">
										<p class="card-text text-secondary fs-6 fw-normal m-0">Tell about your latest product line</p>
									</div>
								</div>
								<div class="row gx-2 pb-3">
									<div class="col-auto">
										<p class="card-text text-purple-600 fs-6 fw-normal mx-auto my-1"><i class="bi bi-check-circle"></i></p>
									</div>
									<div class="col">
										<p class="card-text text-secondary fs-6 fw-normal m-0">Share new funding round news</p>
									</div>
								</div>
								<div class="row gx-2 pb-3">
									<div class="col-auto">
										<p class="card-text text-purple-600 fs-6 fw-normal mx-auto my-1"><i class="bi bi-check-circle"></i></p>
									</div>
									<div class="col">
										<p class="card-text text-secondary fs-6 fw-normal m-0">Tell about latest event/collaboration</p>
									</div>
								</div>
								<a href="{{ route('architect.add-story.press-release.index') }}" class="stretched-link"></a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="card add-story-card rounded-4 shadow border border-1 h-100">
						<div class="card-header rounded-top-4 border-0 py-5">
							<div class="justify-content-center align-items-center d-flex">
								<div class="text-center fs-1 rounded-circle bg-white"><i class="bi bi-plus"></i></div>
							</div>
						</div>
						<div class="card-body">
							<h5 class="card-title text-purple-700 fs-5 fw-semibold m-0 py-2">Create Project Story</h5>
							<div class="pt-3">
								<div class="row gx-2 pb-3">
									<div class="col-auto">
										<p class="card-text text-purple-600 fs-6 fw-normal mx-auto my-1"><i class="bi bi-check-circle"></i></p>
									</div>
									<div class="col">
										<p class="card-text text-secondary fs-6 fw-normal m-0">Share your latest design</p>
									</div>
								</div>
								<div class="row gx-2 pb-3">
									<div class="col-auto">
										<p class="card-text text-purple-600 fs-6 fw-normal mx-auto my-1"><i class="bi bi-check-circle"></i></p>
									</div>
									<div class="col">
										<p class="card-text text-secondary fs-6 fw-normal m-0">Share your latest collection</p>
									</div>
								</div>
								<div class="row gx-2 pb-3">
									<div class="col-auto">
										<p class="card-text text-purple-600 fs-6 fw-normal mx-auto my-1"><i class="bi bi-check-circle"></i></p>
									</div>
									<div class="col">
										<p class="card-text text-secondary fs-6 fw-normal m-0">Share your latest project</p>
									</div>
								</div>
								<div class="row gx-2 pb-3">
									<div class="col-auto">
										<p class="card-text text-purple-600 fs-6 fw-normal mx-auto my-1"><i class="bi bi-check-circle"></i></p>
									</div>
									<div class="col">
										<p class="card-text text-secondary fs-6 fw-normal m-0">Share your latest products</p>
									</div>
								</div>
								<div class="row gx-2 pb-3">
									<div class="col-auto">
										<p class="card-text text-purple-600 fs-6 fw-normal mx-auto my-1"><i class="bi bi-check-circle"></i></p>
									</div>
									<div class="col">
										<p class="card-text text-secondary fs-6 fw-normal m-0">Share your latest work</p>
									</div>
								</div>
								<a href="{{ route('architect.add-story.project.index') }}" class="stretched-link"></a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="card add-story-card rounded-4 shadow border border-1 h-100">
						<div class="card-header rounded-top-4 border-0 py-5">
							<div class="justify-content-center align-items-center d-flex">
								<div class="text-center fs-1 rounded-circle bg-white"><i class="bi bi-plus"></i></div>
							</div>
						</div>
						<div class="card-body">
							<h5 class="card-title text-purple-700 fs-5 fw-semibold m-0 py-2">Create Article</h5>
							<div class="pt-3">
								<div class="row gx-2 pb-3">
									<div class="col-auto">
										<p class="card-text text-purple-600 fs-6 fw-normal mx-auto my-1"><i class="bi bi-check-circle"></i></p>
									</div>
									<div class="col">
										<p class="card-text text-secondary fs-6 fw-normal m-0">Share a thought leadership article</p>
									</div>
								</div>
								<div class="row gx-2 pb-3">
									<div class="col-auto">
										<p class="card-text text-purple-600 fs-6 fw-normal mx-auto my-1"><i class="bi bi-check-circle"></i></p>
									</div>
									<div class="col">
										<p class="card-text text-secondary fs-6 fw-normal m-0">Talk about current events</p>
									</div>
								</div>
								<div class="row gx-2 pb-3">
									<div class="col-auto">
										<p class="card-text text-purple-600 fs-6 fw-normal mx-auto my-1"><i class="bi bi-check-circle"></i></p>
									</div>
									<div class="col">
										<p class="card-text text-secondary fs-6 fw-normal m-0">Share industry insights</p>
									</div>
								</div>
								<div class="row gx-2 pb-3">
									<div class="col-auto">
										<p class="card-text text-purple-600 fs-6 fw-normal mx-auto my-1"><i class="bi bi-check-circle"></i></p>
									</div>
									<div class="col">
										<p class="card-text text-secondary fs-6 fw-normal m-0">Share your journey</p>
									</div>
								</div>
								<div class="row gx-2 pb-3">
									<div class="col-auto">
										<p class="card-text text-purple-600 fs-6 fw-normal mx-auto my-1"><i class="bi bi-check-circle"></i></p>
									</div>
									<div class="col">
										<p class="card-text text-secondary fs-6 fw-normal m-0">Share your perspective</p>
									</div>
								</div>
								<a href="{{ route('architect.add-story.article.index') }}" class="stretched-link"></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
