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
						<a href="{{ route('journalist.account.profile.publications.index') }}" class="text-secondary fs-6 fw-medium">Publications</a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item text-purple-600 fs-6 fw-medium" aria-current="page">{{ $publication->name }}</li>
				</ol>
			</nav>
		</div>
	</div>

	@include('users.includes.journalist.profile-header', ['headerTitle' => 'Publication Profile'])

	{{-- @include('users.includes.architect.pitch-story-header', ['headerTitle' => 'Submit your stories to call for submissions']) --}}

	<hr class="border-gray-300 my-4">

	<livewire:architects.pitch-stories.publication-view :publication="$publication" />
</div>
@endsection

@include('users.includes.architect.pitch-story-modals-script')

