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
						<a href="{{ route('architect.pitch-story.publications.index') }}" class="text-secondary fs-6 fw-medium">Publications</a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="{{ route('architect.pitch-story.journalists.index') }}" class="text-secondary fs-6 fw-medium">Journalists</a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item text-purple-600 fs-6 fw-medium" aria-current="page">{{ $journalist->user->name }}</li>
				</ol>
			</nav>
		</div>
	</div>

	@include('users.includes.architect.pitch-story-header', ['headerTitle' => 'Submit your stories to ' . $journalist->user->name])

	<hr class="border-gray-300 my-4">

	@include('users.includes.common.profile-journalist', [
		'viewAs' => 'architect',
	])
</div>
@endsection

@include('users.includes.architect.pitch-story-modals-script')
