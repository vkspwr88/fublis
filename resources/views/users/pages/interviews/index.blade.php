@extends('users.layouts.master')

{!! seo($SEOData) !!}

@section('body')
<div class="container py-5">
	<div class="mb-5 row">
		<div class="col-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="{{ route('home') }}" class="text-secondary fs-6 fw-medium"><i class="bi bi-house"></i></a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="javascript:;" class="text-secondary fs-6 fw-medium">Interview</a>
					</li>
					{{-- <li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="javascript:;" class="text-secondary fs-6 fw-medium">People</a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="javascript:;" class="text-secondary fs-6 fw-medium">{{ $architect->company->category->name }}</a>
					</li> --}}
					<li class="breadcrumb-item fublis-breadcrumb-item fs-6 fw-medium" aria-current="page">
						<span class="text-purple-600 bg-purple-100 badge">
							{{ Str::headline($interview->slug) }}
						</span>
					</li>
				</ol>
			</nav>
		</div>
		<div class="col-12">
			<h3 class="m-0">Interview</h3>
		</div>
	</div>
	@if($interview->final_submission)
		<div class="row">
			<div class="col">
				<h2 class="text-dark fs-3 fw-semibold">
					Thank You, {{ Str::headline($interview->slug) }}! We've received your interview responses.
				</h2>
				<p class="m-0 text-secondary fs-5">
					Thank you for completing the interview questionnaire! Your responses have been successfully submitted. Our editorial team is now working diligently to get your interview live on our platform soon. We appreciate your time and valuable insights.
				</p>
			</div>
		</div>

		<hr class="my-4 border-gray-300">
	@else
		<div class="row">
			<div class="col">
				<h2 class="m-0 text-dark fs-3 fw-semibold">{{ $interview->heading }}</h2>
				<p class="m-0 text-secondary fs-5">{{ $interview->description }}</p>
			</div>
		</div>

		<hr class="my-4 border-gray-300">

		<livewire:common.interviews.index :$interview />

		@push('scripts')
			<script>
				window.addEventListener('hide-submit-interview-modal', event => {
					$('#submitInterviewModal').modal('hide');
				});
				window.addEventListener('show-submit-interview-modal', event => {
					$('#submitInterviewModal').modal('show');
				});
			</script>
		@endpush

		@include('users.includes.common.profile-script')
	@endif

</div>
@endsection
