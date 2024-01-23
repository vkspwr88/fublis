@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container py-5">
	<div class="row mb-3">
		<div class="col-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="{{ route('home') }}" class="text-secondary fs-6 fw-medium"><i class="bi bi-house"></i></a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="{{ route('architect.pitch-story.calls.index') }}" class="text-secondary fs-6 fw-medium">Calls</a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item text-purple-600 fs-6 fw-medium" aria-current="page">{{ $call->title }}</li>
				</ol>
			</nav>
		</div>
	</div>

	@include('users.includes.architect.pitch-story-header', ['headerTitle' => 'Submit your stories to call for submissions'])

	<hr class="border-gray-300 my-4">

	<div class="row justify-content-center">
		<div class="col-md-9">
			@include('livewire.journalists.calls.view', ['viewAs' => 'architect'])
			<hr class="border-gray-300 my-3">
			<livewire:architects.pitch-stories.call-view :call="$call" />
	</div>
</div>
@endsection

@include('users.includes.architect.pitch-story-modals-script')
