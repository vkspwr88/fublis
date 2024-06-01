@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container py-5">
	<div class="mb-3 row">
		<div class="col-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="{{ route('home') }}" class="text-secondary fs-6 fw-medium"><i class="bi bi-house"></i></a>
					</li>
					<li class="text-purple-600 breadcrumb-item fublis-breadcrumb-item fs-6 fw-medium" aria-current="page">Publications</li>
				</ol>
			</nav>
		</div>
	</div>

	@include('users.includes.architect.pitch-story-header', ['headerTitle' => 'Pitch your stories to publications'])

	<hr class="my-4 border-gray-300">

	<livewire:architects.pitch-stories.publications />
</div>
@endsection

@include('users.includes.architect.pitch-story-modals-script')
